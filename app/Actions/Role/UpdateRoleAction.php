<?php

namespace App\Actions\Role;

use App\Actions\BaseAction;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateRoleAction extends BaseAction
{
    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Role $role, array $data): JsonResponse
    {
        return DB::transaction(function () use ($role, $data) {
            $role->update(Arr::except($data, 'permissions'));
            $role->permissions()->sync(collect(Arr::get($data, 'permissions')));

            return $this->ok($role, RoleTransformer::class);
        });
    }
}
