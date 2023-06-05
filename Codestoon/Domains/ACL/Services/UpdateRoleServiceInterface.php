<?php

namespace Codestoon\Domains\ACL\Services;

use Codestoon\Domains\ACL\DataTransformObjects\UpdateRoleDataTransformObject;

interface UpdateRoleServiceInterface
{
    public function __invoke(UpdateRoleDataTransformObject $updateRoleDataTransformObject): void;
}
