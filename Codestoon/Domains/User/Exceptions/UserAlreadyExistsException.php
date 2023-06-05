<?php

namespace Codestoon\Domains\User\Exceptions;

use Codestoon\Domains\BaseException;

class UserAlreadyExistsException extends BaseException
{
    public function __construct()
    {
        parent::__construct(message: trans('user::validations.UserAlreadyExists'), code: 406);
    }
}
