<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseRequest;

class CreateImageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image' => 'required',
        ];
    }
}
