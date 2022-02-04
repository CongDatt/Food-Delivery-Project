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
        $this->authorizeResource(Dish::class);
    }

    public function index(ShowListDishAction $action): JsonResponse
    {
        return ($action)();
    }

    public function store(CreateDishRequest $request, CreateDishAction $action): JsonResponse
    {
        return ($action)($request->validated());
    }

    public function show(Dish $dish, ShowDetailDishAction $action): JsonResponse
    {
        return ($action)($dish);
    }

    public function update(UpdateDishRequest $request, Dish $dish, UpdateDishAction $action): JsonResponse
    {
        return ($action) ($dish, $request->validated());
    }

    public function destroy(Dish $dish, DeleteDishAction $action)
    {
        return ($action)($dish);
    }
}
