<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\Task\TaskAllocation;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskHasBeenAssigned extends Notification
{
    use Queueable;

    // Initiate Variables

    public $taskId, $task, $user, $writerId;



    /**
     * Create a new notification instance.
     */
    public function __construct($writerId, $taskId)
    {
        //

        $this->writerId = $writerId;

        $this->taskId = $taskId;

        //GetUserName

        $this->user = User::where('id', $this->writerId)->first();

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
                    ->line('Dear Writer.'.' '. $this->user->name)
                    ->line('Your Blog Task' . ' '. $this->task->main_title .' '. 'Has been assigned to you login to accept task')
                    ->action('Login', url('/user/login'))
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
            'title' => 'Hoowdy!' .' '. $this->user->name,
            'message' => 'Congratulations you have been assigned a task today Check on the task dashboard',
        ];
    }
}
