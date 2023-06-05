<?php

namespace Codestoon\Domains\ACL\Exceptions;

use Exception;

class RoleNotFoundException extends Exception
{

    public function __construct()
    {
        parent::__construct(message: trans('acl::validations.RoleNotFound'), code: 404);
    }
}
