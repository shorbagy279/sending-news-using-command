<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SendingNews extends Mailable
{
    public $articles;

    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Latest News Update',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'news',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
