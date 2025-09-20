<?php

namespace App\Filament\Resources\AboutUsConfigResource\Pages;

use App\Filament\Resources\AboutUsConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutUsConfig extends CreateRecord
{
    protected static string $resource = AboutUsConfigResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
