<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DummyDataSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
//        $this->call(CityDataSeeder::class);
    }
}
