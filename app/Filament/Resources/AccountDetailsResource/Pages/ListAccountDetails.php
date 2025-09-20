<?php

namespace App\Filament\Resources\AccountDetailsResource\Pages;

use App\Filament\Resources\AccountDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountDetails extends ListRecords
{
    protected static string $resource = AccountDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
