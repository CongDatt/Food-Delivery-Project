<?php

namespace App\Actions\Dish;

use App\Actions\BaseAction;
use App\Models\Dish;
use App\Transformers\DishTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreateDishAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {

            $dish = Dish::create($data);

            return $this->ok($dish, DishTransformer::class);
        });
    }
}
