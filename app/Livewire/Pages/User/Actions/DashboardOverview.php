<?php

namespace App\Livewire\Pages\User\Actions;

use Livewire\Component;
use App\Models\Task\TaskAllocation;
use Illuminate\Support\Facades\Auth;

class DashboardOverview extends Component
{

    public $taskCount;
    public $rejectedTasks;

    public $approvedTasks;
    public function mount()
    {
        $this->dashboardAnalytics();
    }


    public function dashboardAnalytics()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $getUserDetails = Auth::user();
        $this->taskCount = TaskAllocation::where('writer_id', $getUserDetails->id)->count();
        $this->approvedTasks = TaskAllocation::where('writer_id', $getUserDetails->id)
            ->where('reviewed', true)
            ->where('seo_approved', true)
            ->where('progress', 'done')
            ->count();
    }
    public function render()
    {
        return view('livewire.pages.user.actions.dashboard-overview');
    }
}
