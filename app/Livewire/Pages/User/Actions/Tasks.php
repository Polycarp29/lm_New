<?php

namespace App\Livewire\Pages\User\Actions;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Task\TaskAllocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminSystemNotifications;

class Tasks extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $filterDateFrom = null;
    public $filterDateTo = null;
    public $sortOrder = 'desc';

    public $user;

    #[Layout('components.layouts.main')]
    public function mount()
    {
        $this->user = Auth::user();



        if (!$this->user) {
            return redirect()->to('/login');
        }
    }

    public function getRunningTasksProperty()
    {
        return $this->baseQuery()
            ->where('progress', 'in_progress')
            ->orderBy('created_at', $this->sortOrder)
            ->paginate($this->perPage, pageName: 'running');
    }

    public function getCompletedTasksProperty()
    {
        return $this->baseQuery()
            ->where('progress', 'done')
            ->orderBy('created_at', $this->sortOrder)
            ->paginate($this->perPage, pageName: 'completed');
    }

    public function getRejectedTasksProperty()
    {
        return $this->baseQuery()
            ->where('taskstatus', 'rejected')
            ->orderBy('created_at', $this->sortOrder)
            ->paginate($this->perPage, pageName: 'rejected');
    }

    private function baseQuery()
    {
        $query = TaskAllocation::with([
            'taskcategory', 'reviewer', 'taskcategory.tasktypes', 'taskcategory.tasktypes.taskinsurer'
        ])->where('writer_id', $this->user->id);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('main_keyword', 'like', '%' . $this->search . '%')
                  ->orWhere('main_title', 'like', '%' . $this->search . '%')
                  ->orWhereHas('taskcategory', function($q) {
                      $q->where('task_name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->filterDateFrom) {
            $query->whereDate('created_at', '>=', $this->filterDateFrom);
        }

        if ($this->filterDateTo) {
            $query->whereDate('created_at', '<=', $this->filterDateTo);
        }

        return $query;
    }

    public function redoTask($taskId)
    {
        TaskAllocation::where('id', $taskId)
            ->where('writer_id', $this->user->id)
            ->update([
                'progress' => 'in_progress',
                'taskstatus' => null,
                'doc_link' => null,
                'content' => '',
            ]);

        $taskDetails = TaskAllocation::find($taskId);

        // Send Notification to Sys Admin
        $users = User::whereIn('email', [
            'earnestmbugua268@gmail.com',
            'fb.admin87@protonmail.com',
        ])->get();

        $message = 'The task "' . $taskDetails->main_title . '" assigned to writer "' . $this->user->name . '" has been rejected and set to be redone.';

        Notification::send($users, new AdminSystemNotifications($users, $message));

        return $this->dispatch('showToast', message: 'Task moved back to running.', type: 'success');
    }

    public function render()
    {
        return view('livewire.pages.user.actions.tasks', [
            'runningTasks' => $this->runningTasks,
            'completedTasks' => $this->completedTasks,
            'rejectedTasks' => $this->rejectedTasks,
        ]);
    }
}
