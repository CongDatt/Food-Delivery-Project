<?php

namespace App\Rules;

use App\Enums\RoleType;
use Illuminate\Contracts\Validation\Rule;

class CheckTypeUsername implements Rule
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
        // check format email or phone number
        if (filter_var($value, FILTER_VALIDATE_EMAIL) || preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $value)) {
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
        return trans('message.incorrect_format');
    }
}
