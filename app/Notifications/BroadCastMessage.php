<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BroadCastMessage extends Notification
{
    use Queueable;

    public $message;

    public $title;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $title)
    {
        //

        $this->message = $message;

        $this->title = $title;
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
                    ->subject('New Message Notification')
                    ->line($this->message)
                    ->action('View Message', url('/login'))
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
            'title' => $this->title,
            'message' => $this->message,
        ];
    }



    // public function toBroadcast($notifiable)
    // {
    //     return new BroadCastMessage( [
    //         'message' => $this->message,
    //     ]);
    // }
}
