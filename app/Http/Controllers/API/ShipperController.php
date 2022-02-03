<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Shipper\UpdateShipperRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Actions\Shipper\ShowDetailShipperAction;
use App\Actions\Shipper\ShowListShipperAction;
use App\Actions\Shipper\UpdateShipperAction;
use App\Actions\Shipper\DeleteShipperAction;
use App\Actions\Shipper\CreateShipperAction;

use App\Http\Requests\Shipper\CreateShipperRequest;

class ShipperController extends ApiController
{

    public function __construct()
    {
//        $this->middleware('auth:api')->except('index','show','me');
        $this->authorizeResource(Role::class);
    }
    public function index(ShowListShipperAction $action): JsonResponse
    {
        return ($action)();
    }

    public function store(CreateShipperRequest $request, CreateShipperAction $action)
    {
        return ($action)($request->validated());
    }

    public function show(User $shipper, ShowDetailShipperAction $action): JsonResponse
    {
        return ($action)($shipper);
    }

    public function update(UpdateShipperRequest $request, User $shipper, UpdateShipperAction $action): JsonResponse
    {
        return ($action)($shipper, $request->validated());
    }


    public function destroy(Shipper $shipper, DeleteShipperAction $action)
    {
        return ($action)($shipper);
    }
}
