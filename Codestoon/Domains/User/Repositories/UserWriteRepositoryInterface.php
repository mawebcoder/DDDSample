<?php

namespace Codestoon\Domains\User\Repositories;

use Codestoon\Domains\User\Entities\User;
use Codestoon\Domains\User\ValueObjects\UserValueObject;

interface UserWriteRepositoryInterface
{

    public function store(UserValueObject $userValueObject): void;

    public function update(UserValueObject $userValueObject, int $userId);
}
