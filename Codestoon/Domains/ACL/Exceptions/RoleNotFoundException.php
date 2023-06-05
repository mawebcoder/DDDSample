<?php

namespace Codestoon\Domains\ACL\Exceptions;

use Codestoon\Domains\BaseException;

class RoleNotFoundException extends BaseException
{

    public function __construct()
    {
        parent::__construct(message: trans('acl::validations.RoleNotFound'), code: 406);
    }
}
