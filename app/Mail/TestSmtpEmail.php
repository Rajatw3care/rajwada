<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestSmtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SMTP Test Email — '.(config('app.name') ?: 'Rajwada Events'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test-smtp',
        );
    }
}
