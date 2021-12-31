<?php

namespace App\Actions\Role;

use App\Actions\BaseAction;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailRoleAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(Role $role): JsonResponse
    {
        return $this->ok($role, RoleTransformer::class);
    }
}
