<?php

namespace Codestoon\Domains\ACL\Entities;

use Codestoon\Domains\ACL\Aggregates\PermissionAggregatesTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use PermissionAggregatesTrait;

    protected $table = 'permissions';


    public const COLUMN_PERSIAN_TITLE = 'persian_title';
    public const COLUMN_IS_ACTIVE = 'is_active';
    public const COLUMN_ENGLISH_TITLE = 'english_title';
}
