<?php

namespace Codestoon\Infrastructure\ACL\Repositories;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\ValueObjects\RoleValueObject;

class ACLWriteRepository implements ACLWriteRepositoryInterface
{

    public function store(RoleValueObject $roleValueObject, array $permissionIds):void
    {
        $role = new Role();

        $role->{Role::COLUMN_PERSIAN_TITLE} = $roleValueObject->getPersianTitle();

        $role->{Role::COLUMN_ENGLISH_TITLE} = $roleValueObject->getEnglishTitle();

        $role->{Role::COLUMN_IS_ACTIVE} = $roleValueObject->getIsActive();

        $role->save();

        $role->permissions()->sync($permissionIds);
    }
}
