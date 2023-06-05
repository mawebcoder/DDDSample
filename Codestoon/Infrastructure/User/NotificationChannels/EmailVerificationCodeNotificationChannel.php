<?php

namespace Codestoon\Infrastructure\User\NotificationChannels;

use Codestoon\Domains\User\Entities\User;
use Codestoon\Infrastructure\User\Mails\EmailVerificationCodeMail;
use Codestoon\Infrastructure\User\Notifications\EmailVerificationCodeNotification;
use Illuminate\Support\Facades\Mail;

class EmailVerificationCodeNotificationChannel
{

    public function send(User $user, EmailVerificationCodeNotification $emailVerificationCodeNotification): void
    {
        Mail::to($user)->send(new EmailVerificationCodeMail($emailVerificationCodeNotification->code, $user));
    }
}
