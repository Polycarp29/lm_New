<?php

namespace App\Filament\Resources\MiscsResource\Pages;

use App\Filament\Resources\MiscsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiscs extends EditRecord
{
    protected static string $resource = MiscsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
