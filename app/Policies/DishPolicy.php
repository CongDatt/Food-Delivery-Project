<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Enums\PermissionType;
use App\Models\Role;
use App\Models\User;

class DishPolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $current
     * @return bool
     */
    public function viewAny(User $current): bool
    {
        return $this->author($current, PermissionType::VIEW_DISH);
    }


    public function view(User $current, Role $role): bool
    {
        return $this->author($current, PermissionType::VIEW_DISH);
    }

    public function create(User $current): bool
    {
        return $this->author($current, PermissionType::CREATE_DISH);
    }

 function update(User $current, Role $role): bool
    {
        return $this->author($current, PermissionType::UPDATE_DISH);
    }

    public function delete(User $current, Role $role): bool
    {
        return $this->author($current, PermissionType::DELETE_DISH);
    }
}
