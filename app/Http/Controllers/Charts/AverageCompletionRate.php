<?php

namespace App\Http\Controllers\Charts;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Task\TaskAllocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AverageCompletionRate extends Controller
{
    //
    public function getAverageCompletionRates()
    {
        // Authenticate user
        $user = Auth::user();
        $month = now()->month;
        $year = now()->year;


        // Get Tasks Completed in the month

        $taskallocation = TaskAllocation::with([
            'taskcategory',
            'reviewer',
            'taskcategory.tasktypes',
            'taskcategory.tasktypes.taskinsurer'
        ])->where('progress', 'Done') // <-- only done tasks
            ->whereMonth('updated_at', $month)

            ->whereYear('updated_at', $year)
            ->get();

        $weeklyData = [
            'week1' => [],
            'week2' => [],
            'week3' => [],
            'week4' => [],
        ];


        foreach ($taskallocation as $task) {
            $week = ceil(Carbon::parse($task->updated_at)->day / 7);

            $completion = 0;

            if ($task->due_date) {
                $due = Carbon::parse($task->due_date);
                $completed = Carbon::parse($task->updated_at);
                $diff = $due->diffInSeconds($completed, false);
                if ($diff >= 0) {
                    $completion = 100;
                } else {
                    $completion = max(0, 100 + ($diff / 86400) * 10);
                }
            }

            $weeklyData['week' . $week][] = $completion;
        }

        // Average the completions per week
        $averages = [];

        foreach ($weeklyData as $week => $completions) {
            if (count($completions)) {
                $averages[] = round(array_sum($completions) / count($completions), 2);
            } else {
                $averages[] = 0; // no completed tasks in that week
            }
        }

        return response()->json([
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            'data' => $averages
        ]);
    }
}
