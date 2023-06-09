<?php

namespace Codestoon\Domains\ACL\Entities;

use Codestoon\Domains\ACL\Aggregates\RoleAggregatesTrait;
use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Domains\ACL\Events\RoleDeletedEvent;
use Codestoon\Domains\ACL\Events\RoleUpdatedEvent;
use Codestoon\Infrastructure\ACL\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Codestoon\Domains\BaseModel;

class Role extends BaseModel
{
    use HasFactory;
    use RoleAggregatesTrait;

    protected $table = 'roles';

    protected $dispatchesEvents = [
        'created' => RoleCreatedEvent::class,
        'updated' => RoleUpdatedEvent::class,
        'deleted' => RoleDeletedEvent::class
    ];

    public const COLUMN_PERSIAN_TITLE = 'persian_title';
    public const COLUMN_IS_ACTIVE = 'is_active';
    public const COLUMN_ENGLISH_TITLE = 'english_title';

    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }
}
