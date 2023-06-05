<?php

namespace Codestoon\Presentation\ACL\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleValidation extends FormRequest
{


    public function rules(): array
    {
        return [
            'persian_title' => ['required'],
            'english_title' => ['required'],
            'is_active' => ['required']
        ];
    }
}
