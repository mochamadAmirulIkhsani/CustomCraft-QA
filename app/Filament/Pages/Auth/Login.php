<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class Login extends BaseLogin
{
    /**
     * Handle failed authentication and dispatch SweetAlert event.
     */
    protected function throwFailureValidationException(): never
    {
        // Get email from form data
        $data = $this->form->getState();
        $email = $data['email'] ?? '';
        
        // Check if user exists
        $userExists = \App\Models\User::where('email', $email)->exists();
        
        if (!$userExists) {
            // Email not registered
            $this->dispatch('login-error', [
                'title' => 'Email Tidak Terdaftar!',
                'message' => 'Email yang Anda masukkan tidak terdaftar dalam sistem.',
            ]);
        } else {
            // Email exists but password is wrong
            $this->dispatch('login-error', [
                'title' => 'Password Salah!',
                'message' => 'Password yang Anda masukkan tidak sesuai. Silakan coba lagi.',
            ]);
        }
        
        parent::throwFailureValidationException();
    }
    
    /**
     * Handle rate limiting exception.
     */
    protected function getRateLimitingException(TooManyRequestsException $exception): void
    {
        // Send error notification for rate limiting
        $this->dispatch('login-error', [
            'title' => 'Terlalu Banyak Percobaan!',
            'message' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$exception->secondsUntilAvailable} detik.",
        ]);
        
        throw ValidationException::withMessages([
            'data.email' => __('filament-panels::pages/auth/login.messages.throttled', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]),
        ]);
    }
}
