<?php

namespace App\Actions\Dish;

use App\Actions\BaseAction;
use App\Models\Dish;
use App\Models\Shipper;
use App\Transformers\DishTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailDishAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(Dish $dish): JsonResponse
    {
        return $this->ok($dish, DishTransformer::class);
    }
}
