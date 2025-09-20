<?php

namespace App\Filament\Resources\UpperAboutSectionResource\Pages;

use App\Filament\Resources\UpperAboutSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpperAboutSections extends ListRecords
{
    protected static string $resource = UpperAboutSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
