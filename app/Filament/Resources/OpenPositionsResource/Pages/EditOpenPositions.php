<?php

namespace App\Filament\Resources\OpenPositionsResource\Pages;

use App\Filament\Resources\OpenPositionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOpenPositions extends EditRecord
{
    protected static string $resource = OpenPositionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
