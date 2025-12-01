<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRoleFormComponent(), 
                    ])
                    ->statePath('data'),
            ),
        ];
    }
 
    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->options([
                'buyer' => 'Buyer',
                'seller' => 'Seller',
            ])
            ->default('buyer')
            ->required();
    }

    /**
     * Override email component to only accept @gmail.com emails
     */
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email Address')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(table: 'users', column: 'email')
            ->rules([
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
            ])
            ->validationMessages([
                'regex' => 'Email harus menggunakan domain @gmail.com'
            ])
            ->placeholder('example@gmail.com')
            ->helperText('Hanya email @gmail.com yang diterima')
            ->suffixIcon('heroicon-m-envelope');
    }
}
