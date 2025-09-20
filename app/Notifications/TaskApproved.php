<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\Task\TaskAllocation;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskApproved extends Notification
{
    use Queueable;

    // Initiate Variables

    public $taskName,$taskId;


    public $userId, $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct( $taskId, $userId)
    {
        //

        $this->taskId = $taskId;
        $this->userId = $userId;

        // Get User Name

        $this->userName = User::where('id', $this->userId)->first();
        $this->taskName = TaskAllocation::where('id', $this->taskId)->first();
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
                    ->subject('Howdy!'.''. $this->userName->name. ''. 'You hava a notification')
                    ->line('Congratulations!! Your task' . ' '. $this->taskName->main_keyword . ' '. 'Has been approved')
                    ->action('View Task', url('/user/task_view/' .$this->taskId ))
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
            'title' => 'Task has been approved',
            'message' => 'Your task' . ' '. $this->taskName->main_keyword . 'Has been approved',
        ];
    }
}
