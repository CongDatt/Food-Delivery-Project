<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Shipper\UpdateShipperRequest;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Transformers\OrderTransformer;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;
use App\Actions\Shipper\ShowDetailShipperAction;
use App\Actions\Shipper\ShowListShipperAction;
use App\Actions\Shipper\UpdateShipperAction;
use App\Actions\Shipper\DeleteShipperAction;
use App\Actions\Shipper\CreateShipperAction;

use App\Http\Requests\Shipper\CreateShipperRequest;
use Illuminate\Http\Request;

class ShipperController extends ApiController
{

    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }
    public function index(ShowListShipperAction $action): JsonResponse
    {
        return ($action)();
    }

    public function store(CreateShipperRequest $request, CreateShipperAction $action): JsonResponse
    {
        return ($action)($request->validated());
    }

    public function show(User $shipper, ShowDetailShipperAction $action): JsonResponse
    {
        return ($action)($shipper);
    }

    public function update(UpdateShipperRequest $request, $id): JsonResponse
    {
        $shipper = User::where([
            ['id','=',$id],
            ['is_shipper','=',1],
        ])->first();

        $shipper->update($request->validated());
        $shipper->name = $request->name;
        $shipper->is_shipper   = 1;
        $shipper->save();

        return response()->json([
            'id'           => $shipper->id,
            'shipper_name' => $shipper->name,
            'email'        => $shipper->email,
            'image'        => $shipper->image,
            'phone'        => $shipper->phone,
            'phone_plate'  => $shipper->phone_plate
        ]);
    }


    public function destroy(User $shipper, DeleteShipperAction $action)
    {
        return ($action)($shipper);
    }

    public function me() {
        return $this->success(auth()->user(), ShipperTransformer::class)->respond(JsonResponse::HTTP_OK);
    }


    public function getOrderList (Request $request)
    {
        if($request->input('status') === 1) {
            $orders = Order::where('status', $request->input('status'))->get();
            return $this->ok($orders, OrderTransformer::class);
        }
        elseif ($request->input('status') !== 1) {
            $orders = Order::where('status', $request->input('status'))
                ->get();
            return $this->ok($orders, OrderTransformer::class);
        }
        else {
            $orders = Order::where('shipper_id', auth()->user()->id)->get();
            return $this->ok($orders, OrderTransformer::class);
        }
    }
}
