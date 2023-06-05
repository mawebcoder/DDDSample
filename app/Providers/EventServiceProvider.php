<?php

namespace App\Providers;

use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Infrastructure\ACL\Listeners\SyncRoleWithElasticsearchListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        RoleCreatedEvent::class => [
            SyncRoleWithElasticsearchListener::class
        ]
    ];


    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
