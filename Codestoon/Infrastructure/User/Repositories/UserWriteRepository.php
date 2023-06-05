<?php

namespace Codestoon\Infrastructure\User\Repositories;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Exceptions\RoleNotFoundException;
use Codestoon\Domains\BaseModel;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Domains\User\Exceptions\UserAlreadyExistsException;
use Codestoon\Domains\User\Exceptions\UserNotFoundException;
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

        $user = $this->assignUserProperties($userValueObject, $user);

        $user->save();
    }

    /**
     * @throws Throwable
     */
    private function checkUserAlreadyExists(UserValueObject $userValueObject): void
    {
        $user = User::query()
            ->where(User::COLUMN_EMAIL, $userValueObject->getEmail())
            ->when($userValueObject->getPhoneNumber(), function (Builder $query) use ($userValueObject) {
                $query->orWhere(User::COLUMN_PHONE_NUMBER, $userValueObject->getPhoneNumber());
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

    /**
     * @throws Throwable
     */
    public function update(UserValueObject $userValueObject, int $userId): void
    {
        $this->checkUserAlreadyExistsWhileUpdating($userValueObject, $userId);

        $this->checkRoleExists($userValueObject->getRoleId());

        $user = User::getById($userId);

        throw_if(!$user, UserNotFoundException::class);

        $user = $this->assignUserProperties($userValueObject, $user);

        $user->save();
    }

    private function assignUserProperties(UserValueObject $userValueObject, User $user): User
    {
        $user->{User::COLUMN_EMAIL} = $userValueObject->getEmail();
        $user->{User::COLUMN_FIRST_NAME} = $userValueObject->getFirstName();
        $user->{User::COLUMN_LAST_NAME} = $userValueObject->getLastName();
        $user->{User::COLUMN_PHONE_NUMBER} = $userValueObject->getPhoneNumber();
        $user->{User::COLUMN_IS_ACTIVE} = $userValueObject->getIsActive();
        $user->{User::COLUMN_PASSWORD} = $userValueObject->getPassword();
        $user->{User::COLUMN_ROLE_ID} = $userValueObject->getRoleId();

        return $user;
    }

    /**
     * @throws Throwable
     */
    private function checkUserAlreadyExistsWhileUpdating(UserValueObject $userValueObject, int $userId): void
    {
        $user = User::query()
            ->where(BaseModel::COLUMN_ID, '<>', $userId)
            ->where(function (Builder $query) use ($userValueObject) {
                $query->where(User::COLUMN_EMAIL, $userValueObject->getEmail())
                    ->when(
                        $userValueObject->getPhoneNumber(),
                        fn(Builder $builder) => $builder->orWhere(
                            User::COLUMN_PHONE_NUMBER,
                            $userValueObject->getPhoneNumber()
                        )
                    );
            })->first();

        throw_if($user, UserAlreadyExistsException::class);
    }

    /**
     * @throws Throwable
     */
    public function delete(int $id): void
    {
        $user = User::getById($id);

        throw_if(!$user, UserNotFoundException::class);

        $user->delete();
    }
}
