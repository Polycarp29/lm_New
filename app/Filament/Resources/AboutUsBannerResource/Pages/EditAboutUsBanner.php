<?php

namespace App\Filament\Resources\AboutUsBannerResource\Pages;

use App\Filament\Resources\AboutUsBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutUsBanner extends EditRecord
{
    protected static string $resource = AboutUsBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
