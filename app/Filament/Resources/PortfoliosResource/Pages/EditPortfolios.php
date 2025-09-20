<?php

namespace App\Filament\Resources\PortfoliosResource\Pages;

use App\Filament\Resources\PortfoliosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolios extends EditRecord
{
    protected static string $resource = PortfoliosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
