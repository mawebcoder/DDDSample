<?php

namespace Codestoon\Infrastructure\User\Repositories;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Exceptions\RoleNotFoundException;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Domains\User\Exceptions\UserAlreadyExistsException;
use Codestoon\Domains\User\Repositories\UserWriteRepositoryInterface;
use Codestoon\Domains\User\ValueObjects\UserValueObject;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class UserWriteRepository implements UserWriteRepositoryInterface
{

    /**
     * @throws Throwable
     */
    public function store(UserValueObject $userValueObject): void
    {

        $this->checkUserAlreadyExists($userValueObject);

        $this->checkRoleExists($userValueObject->getRoleId());

        $user = new User();

        $user->{User::COLUMN_EMAIL} = $userValueObject->getEmail();
        $user->{User::COLUMN_FIRST_NAME} = $userValueObject->getFirstName();
        $user->{User::COLUMN_LAST_NAME} = $userValueObject->getLastName();
        $user->{User::COLUMN_PHONE_NUMBER} = $userValueObject->getPhoneNumber();
        $user->{User::COLUMN_IS_ACTIVE} = $userValueObject->getIsActive();
        $user->{User::COLUMN_PASSWORD} = $userValueObject->getPassword();
        $user->{User::COLUMN_EMAIL_VERIFIED_AT} = $userValueObject->getEmailVerifiedAt();
        $user->{User::COLUMN_PHONE_VERIFIED_AT} = $userValueObject->getPhoneVerifiedAt();
        $user->{User::COLUMN_ROLE_ID} = $userValueObject->getRoleId();

        $user->save();

    }

    /**
     * @throws Throwable
     */
    private function checkUserAlreadyExists(UserValueObject $userValueObject): void
    {
        $user = User::query()
            ->where(User::COLUMN_EMAIL, $userValueObject->getEmail())
            ->orWhere(function (Builder $query) use ($userValueObject) {
                $query->whereNotNull(User::COLUMN_PHONE_NUMBER)
                    ->where(User::COLUMN_PHONE_NUMBER, $userValueObject->getPhoneNumber());
            })->first();

        throw_if($user, UserAlreadyExistsException::class);
    }

    /**
     * @throws Throwable
     */
    private function checkRoleExists(?string $roleId): void
    {
        $role = Role::query()->find($roleId);

        throw_if(!$role, RoleNotFoundException::class);
    }
}
