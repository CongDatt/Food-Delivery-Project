<?php

namespace App\Transformers;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Order;
use Flugg\Responder\Transformers\Transformer;

class OrderTransformer extends Transformer
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
    protected $load = [

    ];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Order $order
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => (int) $order->id,
            'merchant_id' => (int) $order->merchant_id,
            'address' => (string) $order->address,
            'delivery_cost' => (int) $order->delivery_cost,
            'items' => [
                $order->items
            ],
            'total_bill' => (int) $order->total_bill,
        ];
    }
}
