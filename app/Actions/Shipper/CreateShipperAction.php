<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreateShipperAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {

            $shipper = User::create($data);
            $shipper->is_shipper = 1;
            $shipper->save();

            // Create merchant role
            $shipperRole = Role::updateOrCreate([
                'name'         => 'shipper',
                'display_name' => 'SHIPPER',
            ]);

            $shipper->assignRole($shipperRole);
//            $shipperRole->syncPermissions(Permission::query()
//                ->where('name', 'like', 'VIEW-DISH')
//                ->orWhere('name', 'like', 'CREATE_DISH')
//                ->orWhere('name', 'like', 'UPDATE-DISH')
//                ->orWhere('name', 'like', 'DELETE-DISH')
//                ->get());

            return response()->json([
                'shipper_name' => $shipper->name,
                'email'        => $shipper->email,
                'phone'        => $shipper->phone,
                'phone_plate'  => $shipper->phone_plate
            ],201);
        });
    }
}
