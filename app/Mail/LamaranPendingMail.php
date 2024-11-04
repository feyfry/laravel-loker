<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LamaranPendingMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $lamaran;

    /**
     * Create a new message instance.
     */
    public function __construct($lamaran)
    {
        // Eager load the needed relationships
        $this->lamaran = $lamaran->load(['applicant.profile', 'jobdesc']);

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('izfaizback00@gmail.com', 'Vespersec Team'),
            subject: 'Status Lamaran: Lamaran Kerja Anda Pending',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.lamaran.pending',
            with: [
                'lamaran' => $this->lamaran,
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
