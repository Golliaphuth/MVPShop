<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'         => 'required|email',
            'phone'         => 'required',
            'last_name'     => 'required|string|min:1',
            'first_name'    => 'required|string|min:1',
            'method'        => 'required',
            'city'          => 'required',
            'city_ref'      => 'sometimes|required|string',
            'warehouse'     => 'required_if:method,self',
            'warehouse_ref' => 'sometimes|required_if:method,self',
            'street'        => 'required_if:method,address',
            'street_ref'    => 'sometimes|required_if:method,address',
            'building'      => 'required_if:method,address',
            'flat'          => 'required_if:method,address',
        ];
    }
}
