<?php

namespace Codestoon\Infrastructure\ACL\Services;

use Codestoon\Domains\ACL\DataTransformObjects\UpdateRoleDataTransformObject;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\Services\UpdateRoleServiceInterface;
use Codestoon\Domains\ACL\ValueObjects\RoleValueObject;
use Codestoon\Infrastructure\ACL\Repositories\ACLWriteRepository;
use Throwable;

class UpdateRoleService implements UpdateRoleServiceInterface
{

    public function __construct(public ACLWriteRepositoryInterface $aclWriteRepository)
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(UpdateRoleDataTransformObject $updateRoleDataTransformObject): void
    {
        $roleValueObject = new RoleValueObject();

        $roleValueObject->setPersianTitle($updateRoleDataTransformObject->persianTitle)
            ->setEnglishTitle($updateRoleDataTransformObject->englishTitle)
            ->setIsActive($updateRoleDataTransformObject->isActive);

        $this->aclWriteRepository->update(
            $updateRoleDataTransformObject->roleId,
            $roleValueObject,
            $updateRoleDataTransformObject->permissions
        );
    }
}
