<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseRequest;

class UpdateRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => 'sometimes|string|unique:roles,name,'.$this->role->id,
            'display_name'  => 'sometimes|string|unique:roles,display_name,'.$this->role->id,
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|integer|exists:permissions,id',
        ];
    }
}
