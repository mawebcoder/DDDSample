<?php

namespace Codestoon\Infrastructure\ACL\Services;

use Codestoon\Domains\ACL\DataTransformObjects\RegisterRoleDataTransformObject;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Domains\ACL\ValueObjects\RoleValueObject;

class RegisterRoleService implements RegisterRoleServiceInterface
{

    public function __construct(public ACLWriteRepositoryInterface $aclWriterRepository)
    {
    }

    public function __invoke(RegisterRoleDataTransformObject $registerRoleDataTransformObject): void
    {
        $roleValueObject = new RoleValueObject();


        $roleValueObject->setIsActive($registerRoleDataTransformObject->isActive)
            ->setEnglishTitle($registerRoleDataTransformObject->englishTitle)
            ->setPersianTitle($registerRoleDataTransformObject->persianTitle);

        $this->aclWriterRepository->store($roleValueObject, $registerRoleDataTransformObject->permissions);
    }
}
