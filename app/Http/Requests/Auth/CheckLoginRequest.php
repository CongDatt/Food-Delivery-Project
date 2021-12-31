<?php

namespace App\Http\Requests\Auth;

use App\Enums\RoleType;
use App\Http\Requests\BaseRequest;
use App\Rules\CheckPasswordAdmin;
use App\Rules\CheckTypeUsername;
use Illuminate\Validation\Rule;

class CheckLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            'guard'    => ['required', Rule::in(RoleType::asArray())],
            'username' => ['required', new CheckTypeUsername($this->guard)],
            'password' => ['required','min:6','max:10',new CheckPasswordAdmin($this->guard)],
        ];
    }
}
