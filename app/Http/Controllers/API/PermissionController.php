<?php

namespace App\Http\Controllers\API;

use App\Actions\Permission\ShowListPermissionAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Actions\Permission\ShowListPermissionAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ShowListPermissionAction $action): JsonResponse
    {
        return ($action)();
    }
}
