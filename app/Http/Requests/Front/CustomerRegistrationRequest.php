<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegistrationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'last_name' => 'required|string|min:2',
            'first_name' => 'required|string|min:2',
            'patronymic' => 'sometimes|string|nullable',
            'location' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
