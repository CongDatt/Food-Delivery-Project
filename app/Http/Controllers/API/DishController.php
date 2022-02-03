<?php

namespace App\Http\Controllers\API;

use App\Actions\Dish\CreateDishAction;
use App\Actions\Dish\DeleteDishAction;
use App\Actions\Dish\ShowDetailDishAction;
use App\Actions\Dish\ShowListDishAction;
use App\Actions\Dish\UpdateDishAction;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Dish\CreateDishRequest;
use App\Http\Requests\Dish\UpdateDishRequest;
use App\Models\Merchant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show','me');
//        $this->authorizeResource(Role::class);
    }
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
    public function update(UpdateDishRequest $request, Dish $dish, UpdateDishAction $action): JsonResponse
    {
        return ($action) ($dish, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish, DeleteDishAction $action)
    {
        return ($action)($dish);
    }
}
