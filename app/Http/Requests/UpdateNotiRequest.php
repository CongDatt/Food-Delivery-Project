<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseRequest;

class UpdateNotiRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => 'required|integer|between:1,1',
        ];
    }
}
