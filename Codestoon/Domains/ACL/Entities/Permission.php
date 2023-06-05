<?php

namespace Codestoon\Domains\ACL\Entities;

use Codestoon\Domains\ACL\Aggregates\PermissionAggregatesTrait;
use Codestoon\Infrastructure\ACL\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Codestoon\Domains\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends BaseModel
{
    use PermissionAggregatesTrait;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'permissions';


    public const COLUMN_PERSIAN_TITLE = 'persian_title';
    public const COLUMN_IS_ACTIVE = 'is_active';
    public const COLUMN_ENGLISH_TITLE = 'english_title';

    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }
}
