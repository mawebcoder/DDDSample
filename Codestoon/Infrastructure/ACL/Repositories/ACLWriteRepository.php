<?php

namespace Codestoon\Infrastructure\ACL\Repositories;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Exceptions\RoleAlreadyExistsException;
use Codestoon\Domains\ACL\Exceptions\RoleNotFoundException;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\ValueObjects\RoleValueObject;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @throws Throwable
     */
    public function update(int $roleId, RoleValueObject $roleValueObject, array $permissions): void
    {
        $this->checkRoleNotExistsBeforeWhileUpdating($roleId, $roleValueObject);

        $role = Role::getById($roleId);

        throw_if(!$role, RoleNotFoundException::class);

        $role->{Role::COLUMN_PERSIAN_TITLE} = $roleValueObject->getPersianTitle();
        $role->{Role::COLUMN_ENGLISH_TITLE} = $roleValueObject->getEnglishTitle();
        $role->{Role::COLUMN_IS_ACTIVE} = $roleValueObject->getIsActive();

        $role->save();

        $role->permissions()->sync($permissions);
    }

    /**
     * @throws Throwable
     */
    private function checkRoleNotExistsBefore(RoleValueObject $roleValueObject): void
    {
        $role = Role::query()->where(Role::COLUMN_ENGLISH_TITLE, $roleValueObject->getEnglishTitle())
            ->orWhere(Role::COLUMN_PERSIAN_TITLE, $roleValueObject->getPersianTitle())
            ->first();

        throw_if($role, RoleAlreadyExistsException::class);
    }

    /**
     * @throws Throwable
     */
    private function checkRoleNotExistsBeforeWhileUpdating(int $roleId, RoleValueObject $roleValueObject): void
    {
        $role = Role::query()
            ->where(Role::COLUMN_ID, '<>', $roleId)
            ->where(function (Builder $query) use ($roleValueObject) {
                $query->where(Role::COLUMN_PERSIAN_TITLE, $roleValueObject->getPersianTitle())
                    ->orWhere(Role::COLUMN_ENGLISH_TITLE, $roleValueObject->getEnglishTitle());
            })->exists();

        throw_if($role, RoleAlreadyExistsException::class);
    }
}
