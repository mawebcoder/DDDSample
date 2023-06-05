<?php

namespace Codestoon\Domains\ACL\Aggregates;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RoleAggregatesTrait
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, User::COLUMN_ROLE_ID);
    }
}
