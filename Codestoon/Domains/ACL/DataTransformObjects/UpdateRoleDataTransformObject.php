<?php

namespace Codestoon\Domains\ACL\DataTransformObjects;

use Illuminate\Http\Request;

readonly class UpdateRoleDataTransformObject
{

    public string $persianTitle;
    public string $englishTitle;
    public bool $isActive;

    public int $roleId;

    public array $permissions;

    public function getDataFromRequest(Request $request): void
    {
        $this->persianTitle = $request->post('persian_title');
        $this->englishTitle = $request->post('english_title');
        $this->isActive = boolval($request->post('is_active'));
        $this->permissions = $request->post('permissions');
        $this->roleId = $request->route('id');
    }
}
