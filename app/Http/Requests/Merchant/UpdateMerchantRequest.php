<?php

namespace App\Http\Requests\Merchant;
use App\Http\Requests\BaseRequest;

class UpdateMerchantRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image' => 'sometimes|string',
            'merchant_name' => 'sometimes|string',
            'address'       => 'sometimes',
        ];
    }
}
