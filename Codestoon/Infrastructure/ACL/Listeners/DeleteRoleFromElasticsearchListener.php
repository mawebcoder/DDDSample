<?php

namespace Codestoon\Infrastructure\ACL\Listeners;

use Codestoon\Domains\ACL\Events\RoleDeletedEvent;

class DeleteRoleFromElasticsearchListener
{

    public function handle(RoleDeletedEvent $roleDeletedEvent)
    {
    }
}
