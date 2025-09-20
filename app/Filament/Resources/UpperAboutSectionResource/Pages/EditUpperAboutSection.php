<?php

namespace App\Filament\Resources\UpperAboutSectionResource\Pages;

use App\Filament\Resources\UpperAboutSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpperAboutSection extends EditRecord
{
    protected static string $resource = UpperAboutSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
