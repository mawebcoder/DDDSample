<?php

namespace Codestoon\Domains\User\Services;

use Codestoon\Domains\User\DataTransformObjects\LoginAdminDataTransformObject;

interface LoginUserServiceInterface
{
    public function __invoke(LoginAdminDataTransformObject $loginAdminDataTransformObject): string;
}
