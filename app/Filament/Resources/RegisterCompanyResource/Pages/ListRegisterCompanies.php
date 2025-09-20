<?php

namespace App\Filament\Resources\RegisterCompanyResource\Pages;

use App\Filament\Resources\RegisterCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegisterCompanies extends ListRecords
{
    protected static string $resource = RegisterCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
