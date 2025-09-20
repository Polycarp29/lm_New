<?php

namespace App\Filament\Resources\PortfoliosResource\Pages;

use App\Filament\Resources\PortfoliosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolios extends ListRecords
{
    protected static string $resource = PortfoliosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
