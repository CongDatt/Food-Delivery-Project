<?php

namespace App\Transformers;

use App\Models\City;
use App\Models\District;
use Flugg\Responder\TransformBuilder;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Support\Arr;

class DistrictTransformer extends Transformer
{
    protected $transformBuilder;

    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'wards' => WardTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    public function __construct(TransformBuilder $transformBuilder)
    {
        $this->transformBuilder = $transformBuilder;
    }

    /**
     * Transform the model.
     *
     * @param \App\Models\District $district
     * @return array
     */
    public function transform(District $district)
    {
        return [
            'id'            => $district->id,
            'name'          => (string) $district->name,
            'code'          => $district->code,
            'division_type' => (string) $district->division_type,
            'parent_code'   => $district->parent_code,
            //'wards'         => Arr::except($district->wards->toArray(), ['created_at,updated_at']),
        ];
    }
}