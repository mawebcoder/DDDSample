<?php

namespace Codestoon\Infrastructure\User\Services;

use Codestoon\Domains\User\Repositories\UserWriteRepositoryInterface;
use Codestoon\Domains\User\Services\DeleteUserServiceInterface;

class DeleteUserService implements DeleteUserServiceInterface
{

    public function __construct(public UserWriteRepositoryInterface $userWriteRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->userWriteRepository->delete($id);
    }
}
