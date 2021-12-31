<?php

namespace App\Transformers;

use App\Models\City;
use Flugg\Responder\Transformers\Transformer;

class CityTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'districts' => DistrictTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];


    /**
     * Transform the model.
     *
     * @param \App\Models\City $city
     * @return array
     */
    public function transform(City $city)
    {
        return [
            'id'            => $city->id,
            'name'          => (string) $city->name,
            'code'          => $city->code,
            'division_type' => (string) $city->division_type,
        ];
    }
}
