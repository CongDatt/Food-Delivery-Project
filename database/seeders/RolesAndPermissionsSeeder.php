<?php

namespace Database\Seeders;

use App\Enums\PermissionType;
use App\Enums\RoleType;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Merchant;
use App\Models\Shipper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // Create all permissions
        foreach (PermissionType::asArray() as $display_name => $name) {
            Permission::updateOrCreate(
                [
                    'name'         => $name,
                    'display_name' => Str::singular($display_name),
                ]
            );
        }

        // Create admin role
        $adminRole = Role::updateOrCreate([
            'name'         => RoleType::ADMIN,
            'display_name' => RoleType::getKey(RoleType::ADMIN),
        ]);
        $adminRole->syncPermissions(Permission::all());

        // Create merchant role
        $merchantRole = Role::updateOrCreate([
            'name'         => 'merchant',
            'display_name' => 'MERCHANT',
        ]);
        $merchant = Merchant::create([
            'merchant_name' => 'acb',
            'email' => 'test@example.com',
            'password' => '123456',
            'address' => 'Quan 7'
        ]);
        $merchant->assignRole($merchantRole);
        $merchantRole->syncPermissions(Permission::query()
                    ->where('name', 'like', 'VIEW-DISH')
                    ->orWhere('name', 'like', 'CREATE_DISH')
                    ->orWhere('name', 'like', 'UPDATE-DISH')
                    ->orWhere('name', 'like', 'DELETE-DISH')
                    ->get());

        // Create user role
        $userRole = Role::updateOrCreate([
            'name'         => 'user',
            'display_name' => 'USER',
        ]);

        // Create shipper role
        $shipperRole = Role::updateOrCreate([
            'name'         => 'shipper',
            'display_name' => 'SHIPPER',
        ]);
        $shipper = Shipper::create([
            'customer_name' => 'Doan',
            'phone' => '1928921',
            'phone_plate' => '01920192',
            'shipper_name' => 'Cong Dat',
            'email' => 'test@example.com',
            'password' => '123456',
        ]);
        $shipper->assignRole($shipperRole);


//        $managerRole->syncPermissions(Permission::query()
//            ->where('name', 'like', 'VIEW-USER')
//            ->get());

    }
}
