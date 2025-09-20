<?php

namespace App\Filament\Resources\RightAboutUsImgResource\Pages;

use App\Filament\Resources\RightAboutUsImgResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRightAboutUsImg extends EditRecord
{
    protected static string $resource = RightAboutUsImgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
