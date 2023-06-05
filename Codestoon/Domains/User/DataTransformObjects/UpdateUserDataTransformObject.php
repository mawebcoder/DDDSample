<?php

namespace Codestoon\Domains\User\DataTransformObjects;

use Illuminate\Http\Request;

readonly class UpdateUserDataTransformObject
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public ?string $phoneNumber;

    public bool $isActive;

    public int $roleId;

    public string $password;
    public int $userId;

    public function getDataFromRequest(Request $request): void
    {
        $this->firstName = $request->post('first_name');
        $this->lastName = $request->post('last_name');
        $this->email = $request->post('email');
        $this->phoneNumber = $request->post('phone_number');
        $this->isActive = boolval($request->post('is_active'));
        $this->roleId = $request->post('role_id');
        $this->password = $request->post('password');
        $this->userId = $request->route('id');
    }
}
