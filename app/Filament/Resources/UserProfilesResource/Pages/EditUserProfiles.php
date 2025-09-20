<?php

namespace App\Filament\Resources\UserProfilesResource\Pages;

use App\Filament\Resources\UserProfilesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserProfiles extends EditRecord
{
    protected static string $resource = UserProfilesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
