<?php

namespace App\Rules;

use App\Enums\RoleType;
use Illuminate\Contracts\Validation\Rule;

class CheckPasswordAdmin implements Rule
{
    protected $guard;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($guard)
    {
        $this->guard = $guard;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->guard === RoleType::ADMIN) {
            return true;
        }
        if ($this->guard === RoleType::USER && preg_match('/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', $value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('message.incorrect_format_password');
    }
}
