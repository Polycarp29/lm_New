<?php

namespace App\Filament\Resources\AboutUsBannerResource\Pages;

use App\Filament\Resources\AboutUsBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutUsBanner extends CreateRecord
{
    protected static string $resource = AboutUsBannerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
