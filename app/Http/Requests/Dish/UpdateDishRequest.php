<?php

namespace App\Http\Requests\Dish;
use App\Http\Requests\BaseRequest;

class UpdateDishRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'dish_name' => 'sometimes|string',
            'desc' => 'sometimes|string',
            'price' => 'sometimes'
        ];
    }
}
