<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailingListSub extends Mailable
{
    use Queueable, SerializesModels;

    private string $title;

    private string $content;

    private string $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $content, string $id)
    {
        $this->title = $title;
        $this->content = $content;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            'emails.mailing_list_sub',
            with: [
                'title' => $this->title,
                'content' => $this->content,
                'id' => $this->id,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
