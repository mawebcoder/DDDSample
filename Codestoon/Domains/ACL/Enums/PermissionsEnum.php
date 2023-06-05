<?php

namespace Codestoon\Domains\ACL\Enums;

use Codestoon\Domains\EnumTrait;

enum PermissionsEnum: string
{
    use EnumTrait;

    case create_users = 'ایجاد کاربران';
    case update_users = 'به روز رسانی کاربران';
    case delete_users = 'حذف کاربران';
    case read_users = 'مشاهده کاربران';

    case create_roles = 'ایجاد نقش';
    case update_roles = 'به روز رسانی نقش';
    case delete_roles = 'حذف نقش';
    case read_roles = 'مشاهده نقش ها';
}
