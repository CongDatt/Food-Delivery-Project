<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|unique:roles,name',
            'display_name'  => 'required|string|unique:roles,display_name',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|integer|exists:permissions,id',
        ];
    }
}
