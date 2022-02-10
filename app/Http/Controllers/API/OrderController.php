<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;

class OrderController extends ApiController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->input('status')) {
            if(auth()->user()->id === 1) {
                $orders = Order::where('status', $request->input('status'));
                return $this->ok($orders, OrderTransformer::class);
            }
            elseif (auth()->user()->is_merchant === 1) {
                $orders = Order::where('id_merchant', auth()->user()->id)
                    ->where('status', $request->input('status'))
                    ->get();
                return $this->ok($orders, OrderTransformer::class);
            }
            else {
                $orders = Order::where('user_id', auth()->user()->id)
                    ->where('status', $request->input('status'))
                    ->get();
                return $this->ok($orders, OrderTransformer::class);
            }
        }
        else {
            if(auth()->user()->id === 1) {
                $orders = Order::all();
                return $this->ok($orders, OrderTransformer::class);
            }
            elseif (auth()->user()->is_merchant === 1) {
                $orders = Order::where('id_merchant', auth()->user()->id)->get();
                return $this->ok($orders, OrderTransformer::class);
            }
            else {
                $orders = Order::where('user_id', auth()->user()->id)->get();
                return $this->ok($orders, OrderTransformer::class);
            }
        }
    }


    public function store(CreateOrderRequest $request)
    {
        $order = new Order();

        $order->user_id = auth()->user()->id;
        $merchant = User::find($request->merchant_id);
        $order->merchant_id = $merchant;

        $order->id_merchant = $request->merchant_id;

        $order->delivery_cost = random_int(0,10000);
        $order->address = $request->address;

        $total_bill = 0;
        $order->status = 0;
        $string_item = [];

        foreach ($request->items as $item) {
            array_push($string_item, $item);
            $total_bill += $item['price'] * $item['quantity'];
        }

        $order->total_bill = $total_bill + $order->delivery_cost;
        $order->items =  json_encode($string_item);

        $order->item_cost = $order->total_bill - $order->delivery_cost;
        $order->save();
        return $this->ok($order, OrderTransformer::class);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return $this->ok($order, OrderTransformer::class);
    }

    /**
     * @param Request $request
     * @param Order $order
     */
    public function update(Request $request, Order $order)
    {
        $order->shipper_id = auth()->user()->id;

        $shipper = User::find(auth()->user()->id);
        $order->shipper_info = $shipper;

        $order->status = $request->status;
        $order->save();
        return $this->ok($order, OrderTransformer::class);
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
