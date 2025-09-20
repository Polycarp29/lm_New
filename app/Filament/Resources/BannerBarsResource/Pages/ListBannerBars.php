<?php

namespace App\Filament\Resources\BannerBarsResource\Pages;

use App\Filament\Resources\BannerBarsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerBars extends ListRecords
{
    protected static string $resource = BannerBarsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
