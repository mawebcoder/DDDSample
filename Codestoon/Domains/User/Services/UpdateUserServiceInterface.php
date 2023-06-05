<?php

namespace Codestoon\Domains\User\Services;

use Codestoon\Domains\User\DataTransformObjects\UpdateUserDataTransformObject;

interface UpdateUserServiceInterface
{

    public function __invoke(UpdateUserDataTransformObject $updateUserDataTransformObject): void;
}
