<?php

namespace Codestoon\Domains\ACL\Services;

interface DeleteRoleServiceInterface
{

    public function __invoke(int $roleId):void;
}
