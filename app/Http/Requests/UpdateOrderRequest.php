<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseRequest;

class UpdateOrderRequest extends BaseRequest
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
            'image' => 'string',
            'phone_plate' => 'sometimes|string',
            'shipper_info' => 'sometimes|string,'.$this->order->id,
        ];
    }
}
