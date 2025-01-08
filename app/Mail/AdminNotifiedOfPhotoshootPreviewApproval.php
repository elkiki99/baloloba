<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotifiedOfPhotoshootPreviewApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
    */

    public $photoshoot;
    public $user;

    public function __construct($photoshoot, $user)
    {
        $this->photoshoot = $photoshoot;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Revisión del photoshoot aprobado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.admin-notified-of-photoshoot-preview-approval',
            with: [
                'photoshoot' => $this->photoshoot,
                'user' => $this->user,
                'url' => url('/photoshoot/' . $this->photoshoot->slug),
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
