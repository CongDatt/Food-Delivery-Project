<?php

namespace App\Actions\City;

use App\Actions\BaseAction;
use App\Models\District;
use App\Transformers\DistrictTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailDistrictAction extends BaseAction
{
    /**
     * @param \App\Models\District $district
     * @return JsonResponse
     */
    public function __invoke(District $district): JsonResponse
    {
        return $this->ok($district, DistrictTransformer::class);
    }
}
