<?php

namespace App\Notifications;


use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAnalysisNotification extends Notification
{
    use Queueable;


    protected $taskTitle;
    protected $mainKeyword;

    /**
     * Create a new notification instance.
     */
    public function __construct($taskTitle, $mainKeyword)
    {
        //
        $this->taskTitle = $taskTitle;
        $this->mainKeyword = $mainKeyword;
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
        ->subject('Task Analysis Complete: ' . $this->taskTitle)
        ->greeting('Hello ' . $notifiable->name . ',')
        ->line('The analysis for the task "' . $this->taskTitle . '" has been completed.')
        ->line('Summary:')
        ->line($this->mainKeyword)
        ->action('View Task', url('/tasks/' . Str::slug($this->taskTitle))) // Adjust this URL to match your route
        ->line('Thank you for using our platform!');
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
            'task' => $this->taskTitle,
            'main_keyword' => $this->mainKeyword,
        ];
    }
}


