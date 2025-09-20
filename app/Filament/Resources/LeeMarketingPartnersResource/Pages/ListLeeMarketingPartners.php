<?php

namespace App\Filament\Resources\LeeMarketingPartnersResource\Pages;

use App\Filament\Resources\LeeMarketingPartnersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeeMarketingPartners extends ListRecords
{
    protected static string $resource = LeeMarketingPartnersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
