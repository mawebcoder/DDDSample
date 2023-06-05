<?php

namespace Codestoon\Domains\ACL\Repositories;

use Codestoon\Domains\ACL\ValueObjects\RoleValueObject;

interface ACLWriteRepositoryInterface
{

    public function store(RoleValueObject $roleValueObject, array $permissionIds): void;

    public function update(int $roleId, RoleValueObject $roleValueObject, array $permissions): void;

    public function delete(int $roleId): void;
}
