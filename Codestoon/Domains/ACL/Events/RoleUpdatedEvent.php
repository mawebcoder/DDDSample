<?php

namespace Codestoon\Domains\ACL\Events;

use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoleUpdatedEvent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Role $role)
    {
    }


}
