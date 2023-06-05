<?php

namespace Codestoon\Domains\User\Exceptions;

use Codestoon\Domains\BaseException;

class UserCredentialsIsInvalidException extends BaseException
{
    public function __construct()
    {
        parent::__construct(message: trans('user::validations.UserCredentialsIsInvalid'), code: 401);
    }
}
