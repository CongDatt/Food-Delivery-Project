<?php

namespace App\Transformers;

use App\Models\Dish;
use Flugg\Responder\Transformers\Transformer;

class DishTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Dish $dish
     * @return array
     */
    public function transform(Dish $dish)
    {
        return [
            'id' => (string) $dish->id,
            'merchant_id' => (int) $dish->user->id,
            'dish_name' => (string) $dish->dish_name,
            'image' => (string) $dish->image,
            'price' => (string) $dish->price,
            'desc' => (string) $dish->desc,
        ];
    }
}
