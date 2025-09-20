<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task\TaskAllocation;
use App\Models\User;
use App\Notifications\TaskDueNotification;

class NotifyDueTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-due-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all the tasks


        // Get all Users

        $users = User::all();


        foreach($users as $user)
        {
            $dueAssignments = $user->taskAllocation()
            ->where('progress',  'in_progress')
                ->whereDate('due_date', '<=', now())
                ->get();


            if($dueAssignments->count())
            {
                $user->notify(new TaskDueNotification($dueAssignments));
            }

        }

        $tasksDue = TaskAllocation::with(['taskcategory', 'writer', 'reviewer', 'seo'])
        ->whereDate('due_date', now()->toDateString());


    }
}
