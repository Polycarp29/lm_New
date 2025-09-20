<?php

namespace App\Filament\Resources\MiscsResource\Pages;

use App\Filament\Resources\MiscsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiscs extends ListRecords
{
    protected static string $resource = MiscsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
