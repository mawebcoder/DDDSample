<?php

namespace App\Providers;

use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Domains\ACL\Events\RoleDeletedEvent;
use Codestoon\Domains\ACL\Events\RoleUpdatedEvent;
use Codestoon\Infrastructure\ACL\Listeners\DeleteRoleFromElasticsearchListener;
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
        ],
        RoleUpdatedEvent::class => [
            SyncRoleWithElasticsearchListener::class
        ],
        RoleDeletedEvent::class => [
            DeleteRoleFromElasticsearchListener::class
        ]
    ];


    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
