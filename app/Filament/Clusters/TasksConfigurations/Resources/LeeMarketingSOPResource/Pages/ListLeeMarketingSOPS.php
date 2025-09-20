<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources\LeeMarketingSOPResource\Pages;

use App\Filament\Clusters\TasksConfigurations\Resources\LeeMarketingSOPResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeeMarketingSOPS extends ListRecords
{
    protected static string $resource = LeeMarketingSOPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
