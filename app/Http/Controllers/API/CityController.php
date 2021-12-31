<?php

namespace App\Http\Controllers\API;

use App\Actions\City\ShowDetailCityAction;
use App\Actions\City\ShowListCityAction;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Actions\City\ShowListCityAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ShowListCityAction $action): JsonResponse
    {
        return ($action)();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\City $city
     * @param \App\Actions\City\ShowDetailCityAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(City $city, ShowDetailCityAction $action): JsonResponse
    {
        return ($action)($city);
    }
}
