<?php

namespace Codestoon\Infrastructure\User\Services;

use Codestoon\Domains\User\DataTransformObjects\RegisterUserDataTransformObject;
use Codestoon\Domains\User\Repositories\UserWriteRepositoryInterface;
use Codestoon\Domains\User\Services\RegisterUserServiceInterface;
use Codestoon\Domains\User\ValueObjects\UserValueObject;

class RegisterUserService implements RegisterUserServiceInterface
{

    public function __construct(public UserWriteRepositoryInterface $userWriteRepository)
    {
    }

    public function __invoke(RegisterUserDataTransformObject $registerUserDataTransformObject): void
    {
        $userValueObject = new UserValueObject();

        $userValueObject->setEmail($registerUserDataTransformObject->email);

        $userValueObject->setEmailVerifiedAt(now());

        $userValueObject->setPhoneNumber($registerUserDataTransformObject->phoneNumber);

        if ($registerUserDataTransformObject->phoneNumber) {
            $userValueObject->setPhoneVerifiedAt(now());
        }
        $userValueObject->setFirstName($registerUserDataTransformObject->firstName);

        $userValueObject->setLastName($registerUserDataTransformObject->lastName);

        $userValueObject->setPassword($registerUserDataTransformObject->password);

        $userValueObject->setIsActive($registerUserDataTransformObject->isActive);

        $userValueObject->setRoleId($registerUserDataTransformObject->roleId);

        $this->userWriteRepository->store($userValueObject);
    }
}
