<?php

namespace App\Http\Controllers\API;

use App\Actions\Dish\CreateDishAction;
use App\Actions\Dish\ShowDetailDishAction;
use App\Actions\Dish\ShowListDishAction;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Dish\CreateDishRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ShowListDishAction $action)
    {
        return ($action)();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDishRequest $request, CreateDishAction $action): JsonResponse
    {
        return ($action)($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish, ShowDetailDishAction $action): JsonResponse
    {
        return ($action)($dish);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
