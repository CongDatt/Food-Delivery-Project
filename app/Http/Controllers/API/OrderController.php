<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Models\Menu;
use App\Models\Dish;
use App\Models\Shipper;
use App\Transformers\OrderTransformer;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController
{

    public function index(): \Illuminate\Http\JsonResponse
    {
        if(auth()->user()->id === 1) {
            $orders = Order::all();
            return $this->ok($orders, OrderTransformer::class);
        }
        
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return $this->ok($orders, OrderTransformer::class);
    }


    public function store(CreateOrderRequest $request)
    {
        $order = new Order();

        $order->user_id = auth()->user()->id;
        $merchant = User::find($request->merchant_id);
        $order->merchant_id = $merchant;

        $order->delivery_cost = random_int(0,10000);
        $order->address = $request->address;

        $total_bill = 0;
        $string_item = [];

        foreach ($request->items as $item) {
            array_push($string_item, $item);
            $total_bill += $item['price'] * $item['quantity'];
        }

        $order->total_bill = $total_bill + $order->delivery_cost;
        $order->save();

        $order->items = $string_item;

        return $this->ok($order, OrderTransformer::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
