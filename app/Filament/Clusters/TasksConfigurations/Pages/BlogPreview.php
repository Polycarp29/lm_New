<?php

namespace App\Filament\Clusters\TasksConfigurations\Pages;

use App\Filament\Clusters\TasksConfigurations;
use App\Models\Task\TaskAllocation;
use Filament\Pages\Page;

class BlogPreview extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.tasks-configurations.pages.blog-preview';

    protected static ?string $cluster = TasksConfigurations::class;


    public int $taskId;

    public ? TaskAllocation $taskData = null;



    public function mount($taskId)
    {
        $this->taskId = $taskId;

        $this->taskData = TaskAllocation::with(['taskcategory', 'writer', 'reviewer'])->findOrFail($taskId);

    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
