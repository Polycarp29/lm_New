<?php

namespace App\Filament\Resources\AboutUsConfigResource\Pages;

use App\Filament\Resources\AboutUsConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutUsConfigs extends ListRecords
{
    protected static string $resource = AboutUsConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
