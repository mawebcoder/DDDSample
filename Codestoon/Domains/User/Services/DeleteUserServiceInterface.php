<?php

namespace Codestoon\Domains\User\Services;

interface DeleteUserServiceInterface
{

    public function __invoke(int $id):void;
}
