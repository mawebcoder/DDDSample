<?php

namespace Codestoon\Presentation\ACL\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleValidation extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'persian_title' => ['required'],
            'is_active' => ['required'],
            'english_title' => ['required']
        ];
    }
}
