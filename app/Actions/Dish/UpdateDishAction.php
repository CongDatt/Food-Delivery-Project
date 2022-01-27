<?php

namespace App\Actions\Dish;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Models\Dish;
use App\Transformers\DishTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateDishAction extends BaseAction
{
    public function __invoke(Dish $dish, array $data): JsonResponse
    {
        return DB::transaction(function () use ($dish, $data) {
            $dish->update($data);

            return $this->ok($dish, DishTransformer::class);
        });
    }
}
