<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        //

        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('njenggrik@gmail.com'),
            subject: 'Send Email',
        );

        // return new Envelope(
        //     subject: 'Send Email',
        // );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('layoutnew.email')
            ->with($this->data);
    }
    public function content(): Content
    {
        return new Content(
            // view: 'layoutnew.email',
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
