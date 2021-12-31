<?php


namespace App\Policies;

use App\Models\User;

class BasePolicy
{
    /**
     * @param \App\Models\User $currentUser
     * @param $permission
     * @return bool
     */
    public function author(User $currentUser, $permission): bool
    {
        return $currentUser->hasPermissionTo($permission);
    }

}
