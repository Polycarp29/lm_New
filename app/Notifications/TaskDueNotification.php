<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskDueNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     *
     */

    protected $task;
    public function __construct($task)
    {
        //
        $this->task = $task;
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
        $message = (new MailMessage)
            ->subject('Reminder: You have due assignments')
            ->line('You have assignments that are due and not yet completed:');

        foreach ($this->task as $assignment) {
            $dueDate = Carbon::parse($assignment->due_date)->format('Y-m-d');
            $message->line("- " . $assignment->main_title . " (Due: " . $dueDate . ")");
        }

        // Optionally link to a general assignments page or first due task
        if ($this->task->isNotEmpty()) {
            $firstAssignment = $this->task->first();
            $message->action('View Assignments', url('/user/task_view/' . $firstAssignment->id));
        }

        return $message;
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
            'message' => 'You have ' . count($this->task) . ' due assignment(s) that are not completed.',

        ];
    }
}
