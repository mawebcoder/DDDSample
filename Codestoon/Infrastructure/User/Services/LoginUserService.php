<?php

namespace Codestoon\Infrastructure\User\Services;

use Codestoon\Domains\User\DataTransformObjects\LoginAdminDataTransformObject;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Domains\User\Exceptions\UserCredentialsIsInvalidException;
use Codestoon\Domains\User\Services\LoginUserServiceInterface;
use Codestoon\Infrastructure\User\Notifications\EmailVerificationCodeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

class LoginUserService implements LoginUserServiceInterface
{


    /**
     * @throws Throwable
     */
    public function __invoke(LoginAdminDataTransformObject $loginAdminDataTransformObject): string
    {
        if (!$this->isCredentialsValid($loginAdminDataTransformObject)) {
            throw new UserCredentialsIsInvalidException();
        }

        $code = $this->generateCode();

        $user = $this->assignCodeToUser($loginAdminDataTransformObject, $code);

        $user->notify(new EmailVerificationCodeNotification($code));

        return $user->{User::COLUMN_TEMPORARY_PASSWORD};
    }

    /**
     * @param LoginAdminDataTransformObject $loginAdminDataTransformObject
     * @return bool
     */
    public function isCredentialsValid(LoginAdminDataTransformObject $loginAdminDataTransformObject): bool
    {
        return Auth::attempt(
            [
                User::COLUMN_EMAIL => $loginAdminDataTransformObject->email,
                User::COLUMN_PASSWORD => $loginAdminDataTransformObject->password
            ]
        );
    }


    public function generateCode(): int
    {
        do {
            $code = mt_rand(10000, 99999);

            $user = User::query()->where(User::COLUMN_EMAIL_VERIFICATION_CODE, $code)->first();
        } while ($user);

        return $code;
    }

    /**
     * @param LoginAdminDataTransformObject $loginAdminDataTransformObject
     * @param mixed $code
     * @return User
     */
    public function assignCodeToUser(LoginAdminDataTransformObject $loginAdminDataTransformObject, mixed $code): User
    {
        /**
         * @type User $user
         */
        $user = User::query()->firstWhere(User::COLUMN_EMAIL, $loginAdminDataTransformObject->email)->first();

        $user->{User::COLUMN_EMAIL_VERIFICATION_CODE} = $code;

        $user->{User::COLUMN_EMAIL_VERIFICATION_CODE_EXPIRES_AT} = now()->addMinutes(5);

        $user->{User::COLUMN_TEMPORARY_PASSWORD} = Str::random(40);

        $user->save();

        return $user;
    }
}
