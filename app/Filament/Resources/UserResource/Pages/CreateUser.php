<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'User created successfully';
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Email verification timestamp for new users can be set to null initially
        if (!isset($data['email_verified_at'])) {
            $data['email_verified_at'] = null;
        }
        
        return $data;
    }
}
