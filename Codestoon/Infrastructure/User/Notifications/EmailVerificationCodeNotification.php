<?php

namespace Codestoon\Infrastructure\User\Notifications;

use Codestoon\Domains\User\Entities\User;
use Codestoon\Infrastructure\User\NotificationChannels\EmailVerificationCodeNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class EmailVerificationCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $code)
    {
        $this->onQueue('high');
    }

    public function via(User $user): array
    {
        return [EmailVerificationCodeNotificationChannel::class];
    }

}
