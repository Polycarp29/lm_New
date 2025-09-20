<?php

namespace App\Filament\Clusters\TasksConfigurations\Pages;

use Filament\Pages\Page;
use App\Models\Task\TaskAllocation;
use App\Filament\Clusters\TasksConfigurations;

class AdminSeoAnalysisPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.clusters.tasks-configurations.pages.admin-seo-analysis-page';

    protected static ?string $cluster = TasksConfigurations::class;

    protected static ?string $slug = 'admin-seo-analysis-page/{taskId}'; // Optional route binding

    public int $taskId;

    public ?TaskAllocation $taskData = null;

    public ?int $seoScore = null;

    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $this->taskData = TaskAllocation::with(['taskcategory', 'writer', 'reviewer'])->findOrFail($taskId);

        // ✅ Get SEO score from the TaskAllocation model
        $this->seoScore = $this->taskData->perfomance_score ?? 0;
    }

    public function getSeoScoreColorProperty(): string
    {
        return match (true) {
            $this->seoScore >= 80 => 'bg-secondary', // green
            $this->seoScore >= 50 => '#eab308', // yellow
            default => '#ef4444',              // red
        };
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

}
