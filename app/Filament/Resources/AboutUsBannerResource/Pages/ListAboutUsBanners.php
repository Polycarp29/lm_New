<?php

namespace App\Filament\Resources\AboutUsBannerResource\Pages;

use App\Filament\Resources\AboutUsBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutUsBanners extends ListRecords
{
    protected static string $resource = AboutUsBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
