<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources\TaskInsurerResource\Pages;

use App\Filament\Clusters\TasksConfigurations\Resources\TaskInsurerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskInsurer extends EditRecord
{
    protected static string $resource = TaskInsurerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
