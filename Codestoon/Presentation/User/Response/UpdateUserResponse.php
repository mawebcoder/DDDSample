<?php

namespace Codestoon\Presentation\User\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateUserResponse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'message' => 'success'
        ];
    }
}
