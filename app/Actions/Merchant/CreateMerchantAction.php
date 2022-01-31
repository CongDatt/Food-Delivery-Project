<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;
use Illuminate\Support\Arr;

class CreateMerchantAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $merchant = new User();

            $merchant->merchant_name = $data['merchant_name'];
            $merchant->email         = $data['email'];
            $merchant->password      = $data['password'];
            $merchant->address      = $data['address'];
            $merchant->is_merchant = 1;

            $merchant->save();

            // Create merchant role
            $merchantRole = Role::updateOrCreate([
                'name'         => 'merchant',
                'display_name' => 'MERCHANT',
            ]);

            $merchant->assignRole($merchantRole);
            $merchantRole->syncPermissions(Permission::query()
                ->where('name', 'like', 'VIEW-DISH')
                ->orWhere('name', 'like', 'CREATE_DISH')
                ->orWhere('name', 'like', 'UPDATE-DISH')
                ->orWhere('name', 'like', 'DELETE-DISH')
                ->get());

            return response()->json($merchant, 201);
        });
    }
}
