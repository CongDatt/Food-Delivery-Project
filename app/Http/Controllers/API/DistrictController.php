<?php

namespace App\Http\Controllers\API;

use App\Actions\City\ShowDetailDistrictAction;
use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\JsonResponse;

class DistrictController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\District $district
     * @param \App\Actions\City\ShowDetailDistrictAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(District $district,ShowDetailDistrictAction $action): JsonResponse
    {
        return ($action)($district);
    }
}
