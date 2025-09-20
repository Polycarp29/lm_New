<?php

namespace App\Filament\Resources\UserProfilesResource\Pages;

use App\Filament\Resources\UserProfilesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserProfiles extends CreateRecord
{
    protected static string $resource = UserProfilesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
