<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Services\VietNamProvincesService;
use Illuminate\Database\Seeder;

class CityDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = VietNamProvincesService::getProvinces();
        foreach ($provinces as $province) {
            City::create([
                'name'          => $province->name,
                'code'          => $province->code,
                'division_type' => $province->division_type,
            ]);
            $districts = VietNamProvincesService::getChildren($provinces, $province->code, 'districts');
            foreach ($districts as $district) {
                District::create([
                    'name'          => $district->name,
                    'code'          => $district->code,
                    'division_type' => $district->division_type,
                    'city_id'       => City::where('code', $province->code)->pluck('id')->first(),
                    'parent_code'   => $province->code,
                ]);
                foreach (VietNamProvincesService::getChildren(collect($districts), $district->code, 'wards') as $ward) {
                    Ward::create([
                        'name'          => $ward->name,
                        'code'          => $ward->code,
                        'division_type' => $ward->division_type,
                        'district_id'   => District::where('code', $district->code)->pluck('id')->first(),
                        'parent_code'   => $district->code,
                    ]);
                }
            }
        }
    }
}
