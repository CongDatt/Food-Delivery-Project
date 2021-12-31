<?php

namespace App\Actions\City;

use App\Actions\BaseAction;
use App\Models\City;
use App\Transformers\CityTransformer;
use Illuminate\Http\JsonResponse;

class ShowListCityAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $city = City::all();

        return $this->ok($city, CityTransformer::class);
    }
}
