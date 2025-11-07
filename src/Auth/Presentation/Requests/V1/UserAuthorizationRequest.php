<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Presentation\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $email
 * @property-read string $password
 */
class UserAuthorizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'string',
                'required',
                'exists:users,email'
            ],
            'password' => [
                'string',
                'required',
                'min:6'
            ],
        ];
    }
}
