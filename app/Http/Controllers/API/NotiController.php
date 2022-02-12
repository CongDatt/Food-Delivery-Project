<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UpdateNotiRequest;
use App\Models\Noti;
use App\Models\Order;
use App\Transformers\NotiTransformer;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;

class NotiController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(auth()->user()->id === 1) {
            return $this->ok(Noti::all(),NotiTransformer::class);
        }
        else{
            $notifications = Noti::where('user_id', auth()->user()->id)->get();
            return $this->ok($notifications, NotiTransformer::class);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noti  $noti
     * @return \Illuminate\Http\Response
     */
    public function show(Noti $noti)
    {
        //
    }

    /**
     * @param UpdateNotiRequest $request
     * @param Noti $noti
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateNotiRequest $request, $id)
    {
        $noti =  Noti::findOrFail($id);
        if($noti) {
            $noti->status = $request->status;
            $noti->save();

            return $this->ok($noti, NotiTransformer::class);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noti  $noti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noti $noti)
    {
        //
    }
}
