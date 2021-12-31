<?php

namespace App\Actions\Permission;

use App\Actions\BaseAction;
use App\Filters\PermissionFilter;
use App\Models\Permission;
use App\Sorts\PermissionSort;
use App\Transformers\PermissionTransformer;
use Illuminate\Http\JsonResponse;

class ShowListPermissionAction extends BaseAction
{
    protected $permissionFilter;

    protected $permissionSort;

    public function __construct(PermissionFilter $permissionFilter, PermissionSort $permissionSort)
    {
        parent::__construct();
        $this->permissionFilter = $permissionFilter;
        $this->permissionSort = $permissionSort;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $permission = Permission::query()
                    ->filter($this->permissionFilter)
                    ->sortBy($this->permissionSort)
                    ->paginate($this->per_page);

        return $this->ok($permission, PermissionTransformer::class);
    }
}
