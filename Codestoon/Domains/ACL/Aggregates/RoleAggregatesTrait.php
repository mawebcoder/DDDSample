<?php

namespace Codestoon\Domains\ACL\Aggregates;

use Codestoon\Domains\ACL\Entities\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait RoleAggregatesTrait
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
