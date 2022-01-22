<?php

namespace App\Transformers;

use App\Models\Shipper;
use Flugg\Responder\Transformers\Transformer;

class ShipperTransformer extends Transformer
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
     * @param Shipper $shipper
     * @return array
     */
    public function transform(Shipper $shipper)
    {
        return [
            'id' => (int) $shipper->id,
            'customer_name' => (string) $shipper->customer_name,
            'shipper_name' => (string) $shipper->shipper_name
        ];
    }
}
