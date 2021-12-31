<?php

namespace App\Actions\City;

use App\Actions\BaseAction;
use App\Models\City;
use App\Transformers\CityTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailCityAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(City $city): JsonResponse
    {
        return $this->ok($city, CityTransformer::class);
    }
}
