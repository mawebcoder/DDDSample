<?php

namespace Codestoon\Domains\ACL\Events;

use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Foundation\Events\Dispatchable;

class RoleCreatedEvent
{
    use Dispatchable;

    public function __construct(public Role $role)
    {

    }
}
