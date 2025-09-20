<?php

namespace App\Livewire\Pages\User\Actions;

use Livewire\Component;
use App\Models\TaskInsurer;
use App\Models\Task\TaskAllocation;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class DashboardTasks extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $user;

    // For resetting page when search updates
    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage(); // go back to page 1 on search
    }

    public function mount()
    {
        $this->user = Auth::user();
        if (!$this->user) {
            return redirect()->route('login');
        }
    }


    public function acceptedTask($taskId)
    {

        if ($this->user) {
            TaskAllocation::updateOrCreate(
                [
                    'writer_id' => $this->user->id,
                    'id' => $taskId,
                ],

                [
                    'progress' => 'in_progress',
                ]
            );
        }

        $this->dispatch('showToast', message: 'Task Accepted', type: 'success');
    }

    public function render()
    {
        $tasks = TaskAllocation::with(['taskcategory', 'taskcategory.tasktypes', 'taskcategory.tasktypes.taskinsurer'])
            ->where('writer_id', $this->user->id)
            ->where('progress', 'pending')
            ->when($this->search, function ($query) {
                $query->where('main_title', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.pages.user.actions.dashboard-tasks', [
            'fetchTaskData' => $tasks
        ]);
    }
}
