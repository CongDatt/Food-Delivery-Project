<?php

namespace App\Transformers;

use App\Models\User;
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
     * @param User $shipper
     * @return array
     */
    public function transform(User $shipper): array
    {
        return [
            'id'           => (string) $shipper->id,
            'shipper_name' => (string) $shipper->name,
            'email' => (string) $shipper->email,
            'phone' => (string) $shipper->phone,
            'phone_plate' => (string) $shipper->phone_plate
        ];
    }
}
