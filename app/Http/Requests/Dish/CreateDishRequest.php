<?php

namespace App\Http\Requests\Dish;
use App\Http\Requests\BaseRequest;

class CreateDishRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'dish_name' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required|string',
            'price' => 'required'
        ];
    }
}
