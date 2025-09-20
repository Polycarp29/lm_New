<?php

namespace App\Filament\Resources\OpenPositionsResource\Pages;

use App\Filament\Resources\OpenPositionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOpenPositions extends ListRecords
{
    protected static string $resource = OpenPositionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
