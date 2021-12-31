<?php

namespace App\Actions\Role;

use App\Actions\BaseAction;
use App\Filters\RoleFilter;
use App\Models\Role;
use App\Sorts\RoleSort;
use App\Transformers\RoleTransformer;
use Illuminate\Http\JsonResponse;

class ShowListRoleAction extends BaseAction
{
    protected $roleFilter;

    protected $roleSort;

    public function __construct(RoleFilter $roleFilter, RoleSort $roleSort)
    {
        parent::__construct();
        $this->roleFilter = $roleFilter;
        $this->roleSort = $roleSort;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $role = Role::query()
                    ->filter($this->roleFilter)
                    ->sortBy($this->roleSort)
                    ->paginate($this->per_page);

        return $this->ok($role, RoleTransformer::class);
    }
}
