<?php

namespace Codestoon\Domains\User\DataTransformObjects;

use Illuminate\Http\Request;

readonly class LoginAdminDataTransformObject
{
    public string $password;
    public string $email;

    public function getDataFromRequest(Request $request): void
    {
        $this->password = $request->post('password');
        $this->email = $request->post('email');
    }
}
