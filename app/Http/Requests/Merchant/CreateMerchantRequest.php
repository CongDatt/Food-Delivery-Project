<?php

namespace App\Http\Requests\Merchant;
use App\Http\Requests\BaseRequest;

class CreateMerchantRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'merchant_name' => 'required|string|unique:merchants,merchant_name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'address'       => 'required',
        ];
    }
}
