<?php

namespace Codestoon\Infrastructure\ACL\Repositories;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Exceptions\RoleAlreadyExistsException;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\ValueObjects\RoleValueObject;
use Throwable;

class ACLWriteRepository implements ACLWriteRepositoryInterface
{

    /**
     * @throws Throwable
     */
    public function store(RoleValueObject $roleValueObject, array $permissionIds): void
    {
        $this->checkRoleNotExistsBefore($roleValueObject);

        $role = new Role();

        $role->{Role::COLUMN_PERSIAN_TITLE} = $roleValueObject->getPersianTitle();

        $role->{Role::COLUMN_ENGLISH_TITLE} = $roleValueObject->getEnglishTitle();

        $role->{Role::COLUMN_IS_ACTIVE} = $roleValueObject->getIsActive();

        $role->save();

        $role->permissions()->sync($permissionIds);
    }

    public function update(RoleValueObject $roleValueObject, array $permissions): void
    {
        // TODO: Implement update() method.
    }

    /**
     * @throws Throwable
     */
    private function checkRoleNotExistsBefore(RoleValueObject $roleValueObject):void
    {
        $role = Role::query()->where(Role::COLUMN_ENGLISH_TITLE, $roleValueObject->getEnglishTitle())
            ->orWhere(Role::COLUMN_PERSIAN_TITLE, $roleValueObject->getPersianTitle())
            ->first();

        throw_if($role, RoleAlreadyExistsException::class);
    }
}
