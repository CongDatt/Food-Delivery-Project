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
            'phone' => ['required_without:mail','regex:/^(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'name' =>  'required|string|min:5',
            'password' => 'required|string' ,
        ];
    }


}
