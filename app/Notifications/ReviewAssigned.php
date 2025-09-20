<?php

namespace App\Notifications;

use App\Models\Task\TaskAllocation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReviewAssigned extends Notification
{
    use Queueable;

    public $reviewerId, $user, $taskId, $task;

    /**
     * Create a new notification instance.
     */
    public function __construct($reviewerId, $taskId)
    {

        //
        $this->reviewerId = $reviewerId;
        $this->taskId = $taskId;


        $this->user = User::where('id', $this->reviewerId)->first();
        $this->task = TaskAllocation::where('id', $this->taskId)->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Dear Reviewer'. '' . $this->user->name)
                    ->line('You have been assigned as a reviewer for article:' .' '. $this->task->main_title)
                    ->action('View Task', url('/admin'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            'title' => 'Please review this Article'. ' '. $this->user->name,
            'message' => 'Check admin dashboard to review pending tasks',
        ];
    }
}
