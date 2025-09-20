<?php

namespace App\Filament\Resources\MiddleAboutSectionResource\Pages;

use App\Filament\Resources\MiddleAboutSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiddleAboutSection extends EditRecord
{
    protected static string $resource = MiddleAboutSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
