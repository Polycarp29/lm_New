<?php

namespace App\Filament\Resources\JoinUsResource\Pages;

use App\Filament\Resources\JoinUsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJoinUs extends EditRecord
{
    protected static string $resource = JoinUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
