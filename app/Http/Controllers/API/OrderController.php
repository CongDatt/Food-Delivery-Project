<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Merchant;
use App\Models\Noti;
use App\Models\Token;
use Exception;
use Kutia\Larafirebase\Facades\Larafirebase;
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

        // step 1: to merchant

        $merchantGetNoti = Token::where('user_id', $order->id_merchant)->first();

        $userPhone = auth()->user()->phone;
        $timeOrder = $order->created_at->format('H:i, Y-m-d');

        $noti = new Noti();
        $noti->title = 'New order';
        $noti->message = "You have a new order from $userPhone at $timeOrder.";
        $noti->user_id = $order->id_merchant;
        $noti->save();

        try {
            $merchantToken = $merchantGetNoti->device_token;
            if($merchantToken) {
                Larafirebase::withTitle('New order')
                    ->withBody("You have a new order form $userPhone at $timeOrder.")
                    ->sendNotification($merchantToken);
            }
        }
        catch (Exception $e) {}

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
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if(auth()->user()->is_shipper === 1) {
            $order->shipper_id = auth()->user()->id;
            $shipper = User::find(auth()->user()->id)->toArray();
            $order->shipper_info = json_encode($shipper);
            $order->status = $request->status;

            $order->save();

            if($request->status === 2) {
                // step 3: shipper take the order

                // to Merchant
                $merchantGetNoti = Token::where('user_id', $order->id_merchant)->first();

                // to User
                $userGetNoti = Token::where('user_id', $order->user_id)->first();

                $noti = new Noti();
                $noti->title = 'Order Delivering';
                $noti->message =  "Order $order->id is being delivered.";
                $noti->user_id = $order->user_id;
                $noti->save();

                try {
                    $merchantToken = $merchantGetNoti->device_token;

                    if($merchantToken) {
                        Larafirebase::withTitle('Order Delivering')
                            ->withBody("Order $order->id is being delivered.")
                            ->sendNotification($merchantToken);
                    }
                }
                catch (Exception $exception) {}

                $noti = new Noti();
                $noti->title = 'Order Delivered';
                $noti->message =  "Shipper have delivered order $order->id";
                $noti->user_id = $order->user_id;
                $noti->save();

                try {
                    $userToken = $userGetNoti->device_token;

                    if($userToken) {
                        Larafirebase::withTitle('Order Delivered')
                            ->withBody("Shipper have delivered order $order->id")
                            ->sendNotification($userToken);
                    }
                }
                catch (Exception $exception) {}
            }

            if($request->status === 3) {

                // step 4: Shipper confirm delivered
                // to Merchant
                $merchantGetNoti = Token::where('user_id', $order->id_merchant)->first();

                // to User
                $userGetNoti = Token::where('user_id', $order->user_id)->first();

                $noti = new Noti();
                $noti->title = 'Order Delivered';
                $noti->message =  "Shipper have delivered order $order->id";
                $noti->user_id = $order->user_id;
                $noti->save();

                try {
                    $merchantToken = $merchantGetNoti->device_token;

                    if($merchantToken) {
                        Larafirebase::withTitle('Order Delivered')
                            ->withBody("Shipper have delivered order $order->id")
                            ->sendNotification($merchantGetNoti);
                    }
                }
                catch (Exception $exception) {}

                $noti = new Noti();
                $noti->title = 'Order Delivered';
                $noti->message =  "Shipper have delivered order $order->id";
                $noti->user_id = $order->user_id;
                $noti->save();

                try {
                    $userToken = $userGetNoti->device_token;

                    if($userToken) {
                        Larafirebase::withTitle('Order Delivered')
                            ->withBody("Shipper have delivered order $order->id")
                            ->sendNotification($userToken);
                    }
                }
                catch (Exception $exception) {}
            }

            return $this->ok($order, OrderTransformer::class);
        }
        else {
            $shipper = User::find($order->shipper_id);
            $order->shipper_info = $shipper;
            $order->status = $request->status;
            $order->save();

            if($request->status === 1) {
                // step 2: merchant confirm
                // to User
                $userGetNoti = Token::where('user_id', $order->user_id)->first();

                $noti = new Noti();
                $noti->title = 'Order Preparing';
                $noti->message =  "Your order (Order ID: $order->id) is preparing";
                $noti->user_id = $order->user_id;
                $noti->save();

                try {
                    $userToken = $userGetNoti->device_token;
                    if($userToken) {
                        Larafirebase::withTitle("New Order")
                            ->withBody("Your order ($order->id) is preparing")
                            ->sendNotification($userToken);
                    }
                }
                catch (Exception $exception) {}

                // to Shipper
                $users = Token::where('is_shipper', 1)
                    ->where('device_token', !null)
                    ->get();

                $subsets = $users->map(function ($user) {
                    return collect($user->toArray())
                        ->only(['device_token'])
                        ->all();
                });

                $shippers = $users->map(function ($user) {
                    return collect($user->toArray())
                        ->only(['user_id'])
                        ->all();
                });

                $tokens = [];
                $shipper_id = [];

                foreach ($subsets as $token) {
                    array_push($tokens, $token['device_token']);
                }

                foreach ($shippers as $shipper) {
                    array_push($shipper_id, $shipper['user_id']);
                }

                $title = [];
                $body = [];
                for($i = 0; $i < count($tokens); $i++){
                    $noti = new Noti();
                    $noti->title = 'New Order';
                    $noti->message = "New order is preparing";
                    $noti->user_id = $shipper_id[$i];
                    $noti->save();
                }

                array_push($title, "Order Preparing");
                array_push($body, "New order is preparing");

                Larafirebase::withTitle($title)
                    ->withBody($body)
                    ->sendNotification($tokens);
            }

            if($request->status === 4) {
                // step 5

                // to Shipper
                $shipperGetNoti = Token::where('user_id', $order->shipper_id)->first();

                $noti = new Noti();
                $noti->title = 'Order Delivered';
                $noti->message = "User have received order $order->id";
                $noti->user_id = $order->shipper_id;
                $noti->save();

                try {
                    $shipperToken = $shipperGetNoti->device_token;

                    if($shipperToken){
                        Larafirebase::withTitle('Order Delivered')
                            ->withBody("User have received order $order->id")
                            ->sendNotification($shipperToken);
                    }
                }
                catch (Exception $exception) {}

                // to Merchant
                $merchantGetNoti = Token::where('user_id', $order->id_merchant)->first();

                $noti = new Noti();
                $noti->title = 'Order Delivered';
                $noti->message =  "User have received order $order->id";
                $noti->user_id = $order->user_id;
                $noti->save();

                try {
                    $merchantToken = $merchantGetNoti->device_token;

                    Larafirebase::withTitle('Order Delivered')
                        ->withBody("User have received order $order->id")
                        ->sendNotification($merchantToken);
                }
                catch (Exception $exception) {}
            }

            return $this->ok($order, OrderTransformer::class);
        }
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
