<?php

namespace App\Notifications;


use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SeoApprovedNotification extends Notification
{
    use Queueable;

    protected string $title;
    protected string $doc_url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $title, $doc_url)
    {
        $this->title = $title;
        $this->doc_url = $doc_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('Your blog post titled "' . $this->title . '" has been analysed for SEO.')
                    ->action('View Blog Document', url($this->doc_url))
                    ->line('Login to your account to view full analysis and your perfomance score');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your blog "' . $this->title . '" has been analysed for SEO',
            'title' => $this->title,
        ];
    }
}
