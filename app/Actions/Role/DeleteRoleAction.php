<?php

namespace App\Actions\Role;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use App\Exceptions\DeleteRoleDefaulException;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DeleteRoleAction extends BaseAction
{
    /**
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Role $role): JsonResponse
    {
        if ($role->name === RoleType::ADMIN) {
            throw new DeleteRoleDefaulException();
        }

        return DB::transaction(function () use ($role) {
            $role->delete();

            return $this->noContent();
        });
    }
}
