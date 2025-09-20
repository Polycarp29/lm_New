<?php

namespace App\Livewire\UserDashboard;

use App\Models\Task;
use Livewire\Component;

class ReviewsSection extends Component
{
    public $title = 'Task Reviews';
    public $reviewData; // Declare a property to store review data

    public function mount()
    {
        $this->showAllTasksWithReviews();
    }

    public function showAllTasksWithReviews()
    {
        // Get the most recent approved task assigned to the authenticated user, including its reviews
        $task = Task::with('taskreview.user') // Eager load reviews and the associated user
            ->where('user_id', auth()->id()) // Filter tasks by the authenticated user
            ->where('status', 'approved') // Assuming you have a status field for approved tasks
            ->latest() // Get the most recent task
            ->first();

        // Calculate percentages of positive, neutral, and negative reviews if task exists
        if ($task) {
            $positiveReviews = $task->taskreview->where('rating', '>=', 4)->count();
            $neutralReviews = $task->taskreview->where('rating', 3)->count();
            $negativeReviews = $task->taskreview->where('rating', '<', 3)->count();
            $totalReviews = $task->taskreview->count();

            // Calculate percentages
            $positivePercentage = $totalReviews ? ($positiveReviews / $totalReviews) * 100 : 0;
            $neutralPercentage = $totalReviews ? ($neutralReviews / $totalReviews) * 100 : 0;
            $negativePercentage = $totalReviews ? ($negativeReviews / $totalReviews) * 100 : 0;

            $this->reviewData = [
                'task' => $task,
                'positivePercentage' => round($positivePercentage),
                'neutralPercentage' => round($neutralPercentage),
                'negativePercentage' => round($negativePercentage),
            ];
        } else {
            // If no approved task is found, you can set reviewData to null or an empty array
            $this->reviewData = null;
        }
    }


    public function render()
    {
        return view('livewire.user-dashboard.reviews-section', [
            'reviewData' => $this->reviewData, // Pass the review data to the view
        ]);
    }
}
