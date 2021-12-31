<?php

namespace App\Http\Controllers\API;

use App\Actions\Role\CreateRoleAction;
use App\Actions\Role\DeleteRoleAction;
use App\Actions\Role\ShowDetailRoleAction;
use App\Actions\Role\ShowListRoleAction;
use App\Actions\Role\UpdateRoleAction;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleController extends ApiController
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Actions\Role\ShowListRoleAction $action
     * @return JsonResponse
     */
    public function index(ShowListRoleAction $action): JsonResponse
    {
        return ($action)();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Role\CreateRoleRequest $request
     * @param \App\Actions\Role\CreateRoleAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRoleRequest $request, CreateRoleAction $action): JsonResponse
    {
        return ($action)($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role
     * @param \App\Actions\Role\ShowDetailRoleAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role, ShowDetailRoleAction $action): JsonResponse
    {
        return ($action)($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Role\UpdateRoleRequest $request
     * @param \App\Models\Role $role
     * @param \App\Actions\Role\UpdateRoleAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRoleRequest $request, Role $role, UpdateRoleAction $action): JsonResponse
    {
        return ($action)($role, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Actions\Role\DeleteRoleAction $action
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteRoleAction $action, Role $role): JsonResponse
    {
        return ($action)($role);
    }
}
