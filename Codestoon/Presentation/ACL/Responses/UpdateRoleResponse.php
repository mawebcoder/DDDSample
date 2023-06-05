<?php

namespace Codestoon\Presentation\ACL\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateRoleResponse extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'message' => 'success'
        ];
    }
}
