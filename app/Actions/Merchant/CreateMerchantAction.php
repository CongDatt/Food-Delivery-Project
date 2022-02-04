<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use App\Models\Merchant;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Transformers\MerchantTransformer;
use App\Transformers\RoleTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;
use Illuminate\Support\Arr;
use App\Enums\PermissionType;

class CreateMerchantAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $merchant = User::create($data);
            $merchant->is_merchant = 1;
            $merchant->save();

            // Create merchant role
            $merchantRole = Role::updateOrCreate([
                'name'         => 'merchant',
                'display_name' => 'MERCHANT',
            ]);

            $merchant->assignRole($merchantRole);
            $merchantRole->syncPermissions(Permission::query()
                ->where('name', 'like', 'VIEW_DISH')
                ->orWhere('name', 'like', 'CREATE_DISH')
                ->orWhere('name', 'like', 'UPDATE_DISH')
                ->orWhere('name', 'like', 'DELETE_DISH')
                ->get());

            return response()->json([
                'merchant_name' => $merchant->merchant_name,
                'address' =>$merchant->address,
                'email' => $merchant->email,
                'category' =>  $merchant->category,
                'image' => $merchant->image,
                'description' => $merchant->category,
            ],201);
//            return $this->ok($merchant, MerchantTransformer::class);
        });
    }
}
