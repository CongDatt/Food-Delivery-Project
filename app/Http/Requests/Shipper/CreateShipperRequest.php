<?php

namespace App\Http\Requests\Shipper;
use App\Http\Requests\BaseRequest;

class CreateShipperRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required_without:phone|unique:users,email|min:10|string|email',
            'name' =>  'required|string|min:5',
            'phone' => 'string|unique:users,phone',
            'image' => 'string',
            'phone_plate' => 'string',
            'password' => 'string',
        ];
    }
}
