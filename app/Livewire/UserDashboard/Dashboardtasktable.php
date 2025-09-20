<?php

namespace App\Livewire\UserDashboard;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Dashboardtasktable extends Component
{
    use WithPagination;

    public $queryString = ['company_issuer', 'task_name', 'task_link'];
    public $search = ""; // Search input
    protected $fetchUserDetails;

    public function updatingSearch()
    {
        // Reset to the first page when search changes
        $this->resetPage();
    }

    public function mount()
    {
        if (auth()->check()) {
            session(['user' => auth()->user()]);
        } else {
            return redirect()->route('login');
        }
    }


    public function render()
    {
        $user = session('user');

        if (!$user) {
            return view('livewire.user-dashboard.dashboardtasktable', ['tasks' => collect()]);
        }

        $tasks = Task::where('user_id', $user->id)
            ->search($this->search)
            ->paginate(5);

        return view('livewire.user-dashboard.dashboardtasktable', ['tasks' => $tasks]);
    }


}
