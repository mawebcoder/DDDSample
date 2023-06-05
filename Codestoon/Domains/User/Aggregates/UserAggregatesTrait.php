<?php

namespace Codestoon\Domains\User\Aggregates;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\File\Entities\File;
use Codestoon\Domains\User\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait UserAggregatesTrait
{

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, User::COLUMN_ROLE_ID);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
