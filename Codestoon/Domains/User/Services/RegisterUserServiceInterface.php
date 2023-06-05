<?php

namespace Codestoon\Domains\User\Services;

use Codestoon\Domains\User\DataTransformObjects\RegisterUserDataTransformObject;

interface RegisterUserServiceInterface
{
    public function __invoke(RegisterUserDataTransformObject $registerUserDataTransformObject): void;
}
