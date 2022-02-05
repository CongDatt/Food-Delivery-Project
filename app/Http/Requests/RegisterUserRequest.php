<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class RegisterUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'email' => 'required_without:phone|unique:users,email|min:10|string|email',
            'name' =>  'required|string|min:5',
            'password' => 'required|string' ,
            'phone' => 'string'
        ];
    }


}
