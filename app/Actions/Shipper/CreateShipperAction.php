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

//            $shipper = new User();
//
//            $shipper->name = $data['name'];
//            $shipper->email         = $data['email'];
//            $shipper->password      = $data['password'];
//            $shipper->phone       = $data['phone'];
//            $shipper->phone_plate      = $data['phone_plate'];
//            $shipper->is_shipper = 1;
//
//            $shipper->save();
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

            return $this->ok($shipper, ShipperTransformer::class);
        });
    }
}
