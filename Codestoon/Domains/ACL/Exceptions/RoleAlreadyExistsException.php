<?php

namespace Codestoon\Domains\ACL\Exceptions;

use Codestoon\Domains\BaseException;

class RoleAlreadyExistsException extends BaseException
{
    public function __construct()
    {
        parent::__construct(message: trans('acl::validations.RoleAlreadyExists'), code: 406);
    }
}
