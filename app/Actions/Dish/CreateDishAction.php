<?php

namespace App\Actions\Dish;

use App\Actions\BaseAction;
use App\Models\Dish;
use App\Transformers\DishTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Merchant;

class CreateDishAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $user = User::find(auth()->user()->id);
            $dish = $user->dish()::create([
                'dish_name' => $data['dish_name'],
                'price' => $data['price'],
                'desc' => $data['desc']
            ]);
            return $this->ok($dish, DishTransformer::class);
        });
    }
}
