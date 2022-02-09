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
            'user_id' => (int) auth()->user()->id,
            'payment_method' => (int) $order->payment_method,
            'item_cost' => (int) $order->item_cost,

            'status' => (int) $order->status,
            'merchant' => [
                'id' => (string) json_decode($order->merchant_id)->id,
                'merchant_name' => (string) json_decode($order->merchant_id)->merchant_name,
                'address' => (string) json_decode($order->merchant_id)->address,
                'email' => (string) json_decode($order->merchant_id)->email,
                'category' => (int) json_decode($order->merchant_id)->category,
                'image' => (string) json_decode($order->merchant_id)->image,
                'description' => (string) json_decode($order->merchant_id)->category,
            ],
            'shipper' => [
                'id'           => null,
                'shipper_name' => null,
                'email' => null,
                'image' => null,
                'phone' => null,
                'phone_plate' => null
            ],
            'user' => [
                'id'    => (string) auth()->user()->id,
                'name'  => (string) auth()->user()->name,
                'email' => (string) auth()->user()->email,
                'phone' => (string) auth()->user()->phone,
                'gender' => (string) auth()->user()->gender,
                'address' => (string) auth()->user()->address,
            ],
            'address' => (string) $order->address,
            'delivery_cost' => (int) $order->delivery_cost,
            'items' => json_decode( $order->items),
            'total_bill' => (int) $order->total_bill,
            'createAt' => (string) $order->created_at,
        ];
    }
}
