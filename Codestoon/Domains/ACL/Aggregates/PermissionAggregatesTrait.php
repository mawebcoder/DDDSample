<?php

namespace Codestoon\Domains\ACL\Aggregates;

use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait PermissionAggregatesTrait
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }
}
