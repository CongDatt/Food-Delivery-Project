<?php

namespace App\Transformers;

use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use Flugg\Responder\Transformers\Transformer;

class WardTransformer extends Transformer
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
     * @param \App\Models\Ward $ward
     * @return array
     */
    public function transform(Ward $ward)
    {
        return [
            'id'            => $ward->id,
            'name'          => (string) $ward->name,
            'code'          => $ward->code,
            'division_type' => (string) $ward->division_type,
            'parent_code'   => $ward->parent_code,
        ];
    }
}
