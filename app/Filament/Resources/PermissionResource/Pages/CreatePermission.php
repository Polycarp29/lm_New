<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;




    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Permission registered')
            ->body('The Permission  has been created successfully.');
    }

    // Redirect back to the List Page

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
