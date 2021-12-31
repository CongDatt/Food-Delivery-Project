<?php

namespace App\Policies;

use App\Enums\PermissionType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $current
     * @return bool
     */
    public function viewAny(User $current): bool
    {
        return $this->author($current, PermissionType::VIEW_ROLE);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $current
     * @param \App\Models\Role $role
     * @return bool
     */
    public function view(User $current, Role $role): bool
    {
        return $this->author($current, PermissionType::VIEW_ROLE);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $current
     * @return bool
     */
    public function create(User $current): bool
    {
        return $this->author($current, PermissionType::CREATE_ROLE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $current
     * @param \App\Models\Role $role
     * @return bool
     */
    public function update(User $current, Role $role): bool
    {
        return $this->author($current, PermissionType::UPDATE_ROLE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $current
     * @param \App\Models\Role $role
     * @return bool
     */
    public function delete(User $current, Role $role): bool
    {
        return $this->author($current, PermissionType::DELETE_ROLE);
    }
}
