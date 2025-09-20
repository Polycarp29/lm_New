<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources\TaskTypeResource\Pages;

use App\Filament\Clusters\TasksConfigurations\Resources\TaskTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaskType extends CreateRecord
{
    protected static string $resource = TaskTypeResource::class;
}
