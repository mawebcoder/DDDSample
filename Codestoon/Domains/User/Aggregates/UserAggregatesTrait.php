<?php

namespace Codestoon\Domains\User\Aggregates;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserAggregatesTrait
{

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, User::COLUMN_ROLE_ID);
    }
}
