<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources\TaskCategoriesResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Notifications\SheetHasBeenCreated;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Notification;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskCategoriesResource;

class CreateTaskCategories extends CreateRecord
{
    protected static string $resource = TaskCategoriesResource::class;


    public function afterCreate()
    {

            $users = User::all();

            foreach($users as $user)
            {
                Notification::send($user, new SheetHasBeenCreated($user->name));
            }

    }
}
