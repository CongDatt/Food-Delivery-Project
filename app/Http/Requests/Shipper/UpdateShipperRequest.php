<?php

namespace App\Http\Requests\Shipper;
use App\Http\Requests\BaseRequest;

class UpdateShipperRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'shipper_name' => 'sometimes|string',
            'email' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'phone_plate' => 'sometimes|string',
        ];
    }
}
