<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\Task\TaskAllocation;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskHasBeenReviewed extends Notification
{
    use Queueable;

    public $taskId;
    public $writerId;

    public $writerName;

    public $taskName;



    /**
     * Create a new notification instance.
     */
    public function __construct($taskId, $writerId)
    {
        //
        $this->taskId = $taskId;
        $this->writerId = $writerId;

        $this->writerName = User::where('id', $writerId)->first();
        $this->taskName = TaskAllocation::where('id', $taskId)->first();
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
            ->line('Dear.' . ' ' . $this->writerName->name)
            ->line('This is to inform you that Blog Task' . ' ' . $this->taskName->main_title . ' '.  'Has been reviewed')
            ->action('Comments', url('/user/login'))
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
            'message' => 'Your Blog Task' .' '. $this->taskName->main_title . ' '. 'Has been approved',
            'title' => $this->writerName->name,
        ];
    }
}
