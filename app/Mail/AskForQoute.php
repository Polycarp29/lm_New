<?php

namespace App\Mail;


use App\Models\Miscs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AskForQoute extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $data;

    public $logo;
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
            subject: 'Qoute Enquiry',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.qoute',
            with: [
                'serviceId' => $this->data['serviceId'],
                'service_name' => $this->data['service_name'],
                'firstname' => $this->data['fname'],
                'lastname' => $this->data['lname'],
                'logo' => $this->logo,
            ],
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