<?php

namespace Codestoon\Presentation\User\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserValidationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'first_name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'email' => ['bail', 'required', 'email'],
            'password' => ['bail', 'required', Password::min(8)->mixedCase()->letters()->symbols()->numbers()],
            'confirm_password' => ['bail', 'required', 'same:password'],
            'is_active' => ['bail', 'required'],
            'role_id' => ['bail', 'required', 'integer'],
            'phone_number' => ['sometimes', 'regex:/^09(1|0|2|3|4|9)[0-9][0-9]{7}$/']
        ];
    }
}
