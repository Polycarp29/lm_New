<?php

namespace App\Livewire\UserDashboard;

use App\Models\Task;
use App\Models\Payment;
use Livewire\Component;
use App\Models\TasksConfig;
use App\Models\TaskCategory;
use Illuminate\Support\Facades\Auth;

class DashboardCardComponent extends Component
{
    public $rejectedTasks, $countTasks, $statisticData, $approvedTasks, $payments, $totalEarnings;

    protected $approved, $rejected, $userDetails, $fetchEarnings;

    public function mount()
    {
        // Initialize the component
        $this->getOverView();
    }

    public function getOverView()
    {
        // Get authenticated user
        $this->userDetails = Auth::user();

        if ($this->userDetails) {
            // Fetch tasks directly from the database with appropriate filters
            $this->statisticData = Task::where('user_id', $this->userDetails->id)->get();

            // Count total tasks
            $this->countTasks = $this->statisticData->count();

            // Count rejected tasks
            $this->rejectedTasks = $this->statisticData->where('status', 'rejected')->count();

            // Count approved tasks
            $this->approvedTasks = $this->statisticData->where('status', 'approved')->count();


            $this->fetchEarnings = Payment::where('created_at', now()->month)->where('user_id', $this->userDetails->id)->get();


            $this->fetchEarnings = Payment::whereMonth('created_at', now()->month)
                ->where('user_id', $this->userDetails->id)
                ->get();

            // Calculate the total
            $this->totalEarnings = $this->fetchEarnings->sum('amount');
        } else {
            // Default values if no user is authenticated
            $this->statisticData = collect();
            $this->countTasks = 0;
            $this->rejectedTasks = 0;
            $this->approvedTasks = 0;
            $this->totalEarnings = 0.00;
        }
    }

    public function render()
    {
        return view('livewire.user-dashboard.dashboard-card-component');
    }
}
