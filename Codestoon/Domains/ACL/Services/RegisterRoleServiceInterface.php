<?php

namespace Codestoon\Domains\ACL\Services;

use Codestoon\Domains\ACL\DataTransformObjects\RegisterRoleDataTransformObject;

interface RegisterRoleServiceInterface
{
    public function __invoke(RegisterRoleDataTransformObject $registerRoleDataTransformObject): void;
}
