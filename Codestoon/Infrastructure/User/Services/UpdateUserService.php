<?php

namespace Codestoon\Infrastructure\User\Services;

use Codestoon\Domains\User\DataTransformObjects\UpdateUserDataTransformObject;
use Codestoon\Domains\User\Repositories\UserWriteRepositoryInterface;
use Codestoon\Domains\User\Services\UpdateUserServiceInterface;
use Codestoon\Domains\User\ValueObjects\UserValueObject;

class UpdateUserService implements UpdateUserServiceInterface
{

    public function __construct(public UserWriteRepositoryInterface $userWriteRepository)
    {
    }

    public function __invoke(UpdateUserDataTransformObject $updateUserDataTransformObject): void
    {
        $userValueObject = new UserValueObject();

        $userValueObject->setEmail($updateUserDataTransformObject->email);

        $userValueObject->setEmailVerifiedAt(now());

        $userValueObject->setPhoneNumber($updateUserDataTransformObject->phoneNumber);

        $userValueObject->setFirstName($updateUserDataTransformObject->firstName);

        $userValueObject->setLastName($updateUserDataTransformObject->lastName);

        $userValueObject->setPassword($updateUserDataTransformObject->password);

        $userValueObject->setIsActive($updateUserDataTransformObject->isActive);

        $userValueObject->setRoleId($updateUserDataTransformObject->roleId);

        $this->userWriteRepository->update($userValueObject, $updateUserDataTransformObject->userId);
    }
}
