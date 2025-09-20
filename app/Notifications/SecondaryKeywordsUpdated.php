<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Task\TaskAllocation;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SecondaryKeywordsUpdated extends Notification
{
    use Queueable;

    public $writerId;
    public $taskTitle;

    public $taskId;



    /**
     * Create a new notification instance.
     */
    public function __construct($writerId, $taskId)
    {
        //

        $this->writerId = $writerId;
        $this->taskId = $taskId;

        $this->taskTitle = TaskAllocation::where('id', $this->taskId)->first();

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
                    ->line('The Blog Task.' . $this->taskTitle->main_title)
                    ->line('Secondary Keywords have been updated Click View Task to be able to submit task')
                    ->action('View Task', url('/user/task_view/' . $this->taskId))
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
        ];
    }
}
