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
            'id' => (int) $dish->id,
            'merchant_id' => (string) $dish->merchant_id,
        ];
    }
}
