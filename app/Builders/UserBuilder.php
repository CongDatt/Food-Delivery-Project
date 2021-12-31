<?php

namespace App\Builders;

use App\Enums\RoleType;
use Illuminate\Support\Facades\Auth;

class UserBuilder extends Builder
{
    public function listUser(): UserBuilder
    {
        $current = Auth::user();
        // if $current isn't admin, it'll assign a condition is a list without admin's account
        if (! $current->isAdmin()) {
            $this->whereHas('roles', function ($query) {
                return $query->where('name', '!=', RoleType::ADMIN);
            });
        }

        return $this;
    }
}
