<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contactMessage)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Enquiry from '.$this->contactMessage->name.' — '.(config('app.name') ?: 'Rajwada Events'),
            replyTo: $this->contactMessage->email,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-contact-enquiry',
        );
    }
}
