<?php

namespace Database\Seeders;

use App\Enums\PermissionType;
use App\Enums\RoleType;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Merchant;
use App\Models\Shipper;
use App\Models\User;
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

        $admin = User::create([
            'email'             => null,
            'name'              => 'admin',
            'password'          => '123456',
            'phone'             => null,
            'gender'            => null,
            'date_of_birth'     => null,
            'remember_token'    => Str::random(10),
        ]);
        // assign admin role to admin
        $admin->syncRoles(Role::where('name', RoleType::ADMIN)->first());



        // Create merchant role
        $merchantRole = Role::updateOrCreate([
            'name'         => 'merchant',
            'display_name' => 'MERCHANT',
        ]);
        $merchant1 = User::create([
            'merchant_name' => 'merchant example',
            'email' => 'merchant1@gmail.com',
            'password' => '123456',
            'is_merchant' => 1,
            'address' => 'Quan 7'
        ]);
        $merchant1->assignRole($merchantRole);
        $merchantRole->syncPermissions(Permission::query()
                    ->where('name', 'like', 'VIEW-DISH')
                    ->orWhere('name', 'like', 'CREATE_DISH')
                    ->orWhere('name', 'like', 'UPDATE-DISH')
                    ->orWhere('name', 'like', 'DELETE-DISH')
                    ->get());

        $merchant2 = User::create([
            'merchant_name' => 'merchant example',
            'email' => 'merchant2@gmail.com',
            'password' => '123456',
            'is_merchant' => 1,
            'address' => 'Quan 7'
        ]);
        $merchant2->assignRole($merchantRole);
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
        $user = User::create([
            'email'             => 'congdat@gmail.com',
            'name'              => 'Cong Dat',
            'password'          => '123456',
            'phone'             => null,
            'gender'            => null,
            'date_of_birth'     => null,
            'remember_token'    => Str::random(10),
        ]);
        $user->assignRole($userRole);


        // Create user role
        $userRole = Role::updateOrCreate([
            'name'         => 'shipper',
            'display_name' => 'SHIPPER',
        ]);
        $user = User::create([
            'email'             => 'shipper@gmail.com',
            'name'              => 'Dat Shipper',
            'password'          => '123456',
            'phone'             => null,
            'gender'            => null,
            'date_of_birth'     => null,
            'remember_token'    => Str::random(10),
        ]);
        $user->assignRole($userRole);
    }
}
