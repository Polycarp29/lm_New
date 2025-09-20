<?php

namespace App\Mail;

use App\Models\Miscs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $logo;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        //

        $this->data = $data;

        $this->logo = Miscs::get();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Application has been recieved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.application',
            with:
            [
               'fname' =>  $this->data['fname'],
               'mname' => $this->data['mname'],
               'lname' => $this->data['lname'],
               'logo'  => $this->logo,
             ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
