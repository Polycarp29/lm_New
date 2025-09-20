<?php

namespace App\Filament\Resources\RightAboutUsImgResource\Pages;

use App\Filament\Resources\RightAboutUsImgResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRightAboutUsImgs extends ListRecords
{
    protected static string $resource = RightAboutUsImgResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
