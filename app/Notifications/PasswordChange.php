<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordChange extends Notification
{
    use Queueable;

    public $email;
    public $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct($email)
    {
        //
        $this->email = $email;

        $this->userName = User::where('email', $this->email)->first();
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
                    ->line('Hi.'. ' ' . $this->userName->name . ' '.'!')
                    ->action('Your password has been changed login', url('/login'))
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
            'message' => 'Your password has been changed contact us if this action was not initiated by you',
            'title' => 'Action required!'
        ];
    }
}
