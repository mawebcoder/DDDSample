<?php

namespace Codestoon\Domains\User\Repositories;

use Codestoon\Domains\User\ValueObjects\UserValueObject;

interface UserWriteRepositoryInterface
{

    public function store(UserValueObject $userValueObject): void;
}
