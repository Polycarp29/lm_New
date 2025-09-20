<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatMessageNotification extends Notification
{
    use Queueable;
    protected $recieverName;

    /**
     * Create a new notification instance.
     */
    public function __construct($recieverName)
    {
        //
        $this->recieverName = $recieverName;
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
                    ->line('Hello!'. $this->recieverName)
                    ->line('You have recieved a new message')
                    ->action('Message', url('/login'))
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
            'message' => 'You have a new message from' . $this->recieverName,
            'title' => $this->recieverName,
        ];
    }
}
