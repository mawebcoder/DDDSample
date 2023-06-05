<?php

namespace Codestoon\Infrastructure\User\Mails;

use Codestoon\Domains\User\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerificationCodeMail extends Mailable
{

    public function __construct(public string $code, public User $user)
    {
        $this->user->refresh();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.email-verification-code',
        );
    }

}
