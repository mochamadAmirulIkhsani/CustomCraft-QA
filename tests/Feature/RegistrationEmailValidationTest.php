<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RegistrationEmailValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that registration rejects invalid email formats.
     */
    public function test_registration_rejects_invalid_email_format(): void
    {
        $invalidEmails = [
            'invalid-email',
            'noatsymbol.com',
            'bad@domain',
            'also@bad@domain.com',
            'test@',
            '@example.com',
            'test..email@example.com',
            'test@example..com',
            // Non-Gmail domains (untuk Filament registration)
            'user@yahoo.com',
            'user@outlook.com',
            'user@example.com',
            'admin@customcraft.com',
        ];

        foreach ($invalidEmails as $email) {
            $data = [
                'name' => 'Test User',
                'email' => $email,
                'password' => 'Password123!',
                'role' => 'user',
            ];

            // Validation untuk Filament registration (hanya @gmail.com)
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
                    'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
                ],
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,user,buyer,seller',
            ]);

            $this->assertTrue(
                $validator->fails(),
                "Email '{$email}' should be rejected but was accepted."
            );

            $this->assertArrayHasKey(
                'email',
                $validator->errors()->toArray(),
                "Email '{$email}' should have validation error."
            );
        }
    }

    /**
     * Test that registration accepts valid email formats.
     */
    public function test_registration_accepts_valid_email_format(): void
    {
        // Hanya Gmail yang diterima
        $validEmails = [
            'user@gmail.com',
            'test.user@gmail.com',
            'admin123@gmail.com',
            'first.last@gmail.com',
            'user+tag@gmail.com',
        ];

        foreach ($validEmails as $email) {
            $data = [
                'name' => 'Test User',
                'email' => $email,
                'password' => 'Password123!',
                'role' => 'user',
            ];

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
                    'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
                ],
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,user,buyer,seller',
            ]);

            $this->assertFalse(
                $validator->fails(),
                "Email '{$email}' should be accepted but was rejected: " . 
                json_encode($validator->errors()->toArray())
            );
        }
    }

    /**
     * Test that registration rejects duplicate emails.
     */
    public function test_registration_rejects_duplicate_email(): void
    {
        // Create existing user with Gmail
        User::factory()->create([
            'email' => 'existing@gmail.com',
        ]);

        $data = [
            'name' => 'New User',
            'email' => 'existing@gmail.com',
            'password' => 'Password123!',
            'role' => 'user',
        ];

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user,buyer,seller',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
        $this->assertStringContainsString(
            'has already been taken',
            $validator->errors()->first('email')
        );
    }

    /**
     * Test that registration requires email field.
     */
    public function test_registration_requires_email(): void
    {
        $data = [
            'name' => 'Test User',
            'password' => 'Password123!',
            'role' => 'user',
        ];

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
    }
}
