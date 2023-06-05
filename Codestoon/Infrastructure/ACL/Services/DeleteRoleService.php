<?php

namespace Codestoon\Infrastructure\ACL\Services;

use Codestoon\Domains\ACL\Services\DeleteRoleServiceInterface;
use Codestoon\Infrastructure\ACL\Repositories\ACLWriteRepository;
use Throwable;

class DeleteRoleService implements DeleteRoleServiceInterface
{

    public function __construct(public ACLWriteRepository $aclWriteRepository)
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(int $roleId):void
    {
        $this->aclWriteRepository->delete($roleId);
    }
}
