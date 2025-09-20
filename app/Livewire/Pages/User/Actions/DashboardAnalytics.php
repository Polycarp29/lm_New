<?php

namespace App\Livewire\Pages\User\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Task\TaskAllocation;
use Illuminate\Support\Facades\Auth;

class DashboardAnalytics extends Component
{

    public $userId;
    public $monthlyPerformance = [];

    public $blogPerformance = [];



    // Accept the user ID when the component is mounted
    public function mount()
    {
        $this->userId = Auth::user();

        // Get average performance score per month for the given user
        $this->monthlyPerformance = TaskAllocation::where('writer_id', $this->userId->id)
            ->selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month, AVG(perfomance_score) as average_score')
            ->groupBy('month_number', 'month')
            ->orderBy('month_number')
            ->pluck('average_score', 'month')
            ->toArray();


        $this->blogPerformance = TaskAllocation::where('writer_id', $this->userId->id)
            ->select('main_title', 'perfomance_score', 'created_at')
            ->get()
            ->map(function ($task) {
                return [
                    'label' => \Carbon\Carbon::parse($task->created_at)->format('M d'), // e.g., "May 27"
                    'full_title' => $task->main_title,
                    'score' => $task->perfomance_score,
                ];
            });
    }
    public function render()
    {
        return view('livewire.pages.user.actions.dashboard-analytics');
    }
}
