<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;
use App\Rules\CurrentPassword;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('changePassword')
                ->label('Change Password')
                ->icon('heroicon-o-key')
                ->color('warning')
                ->form([
                    Forms\Components\TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->required()
                        ->rules([new CurrentPassword()]),
                    Forms\Components\TextInput::make('new_password')
                        ->label('New Password')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->same('new_password_confirmation'),
                    Forms\Components\TextInput::make('new_password_confirmation')
                        ->label('Confirm New Password')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->dehydrated(false),
                ])
                ->action(function (array $data): void {
                    $this->record->update([
                        'password' => Hash::make($data['new_password']),
                    ]);
                })
                ->successNotificationTitle('Password updated successfully'),
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'User updated successfully';
    }
}
