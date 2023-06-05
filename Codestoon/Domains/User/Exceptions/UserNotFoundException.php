<?php

namespace Codestoon\Domains\User\Exceptions;

use Codestoon\Domains\BaseException;

class UserNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct(message: trans('user::validations.UserNotFound'), code: 406);
    }
}
