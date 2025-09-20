<?php

namespace App\Filament\Clusters\Alerts\Resources\NotificationsResource\Pages;

use App\Filament\Clusters\Alerts\Resources\NotificationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotifications extends ListRecords
{
    protected static string $resource = NotificationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
