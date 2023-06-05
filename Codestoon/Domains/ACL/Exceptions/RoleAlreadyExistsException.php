<?php

namespace Codestoon\Domains\ACL\Exceptions;

use Exception;

class RoleAlreadyExistsException extends Exception
{
    public function __construct()
    {
        parent::__construct(message: trans('acl::validations.RoleAlreadyExists'), code: 406);
    }
}
