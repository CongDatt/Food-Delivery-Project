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
            'customer_name' => 'required|string|unique:shippers,customer_name',
            'shipper_name' => 'required|string|unique:shippers,shipper_name',
        ];
    }
}
