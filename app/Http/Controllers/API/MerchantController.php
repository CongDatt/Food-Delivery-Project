<?php

namespace App\Http\Controllers\API;

use App\Actions\Merchant\ShowDetailMerchantAction;
use App\Models\Admin;
use App\Models\User;
use App\Models\Merchant;
use App\Models\Role;
use App\Transformers\MerchantTransformer;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\JsonResponse;
use App\Actions\Merchant\ShowListMerchantAction;
use App\Actions\Merchant\CreateMerchantAction;
use App\Http\Requests\Merchant\CreateMerchantRequest;
use App\Http\Requests\Merchant\UpdateMerchantRequest;
use App\Actions\Merchant\UpdateMerchantAction;
use App\Actions\Merchant\DeleteMerchantAction;
use App\Actions\Merchant\MerchantLoginAction;
use App\Http\Requests\Auth\CheckLoginRequest;
use Psy\Util\Json;

class MerchantController extends ApiController
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    public function index(ShowListMerchantAction $action):JsonResponse
    {
        return ($action)();
    }

    public function store(CreateMerchantRequest $request, CreateMerchantAction $action)
    {
        return ($action)($request->validated());
    }

    public function show($id) {
        $merchant = User::where([
            ['id','=',$id],
            ['is_merchant','=',1],
        ])->get();

        return response()->json([
            'id'            => (string) $merchant->id,
            'merchant_name' => $merchant->merchant_name,
            'address'       => $merchant->address,
            'email'         => $merchant->email,
            'category'      =>  $merchant->category,
            'image'         => $merchant->image,
            'description'   => $merchant->category,
        ]);
    }

    public function update(UpdateMerchantRequest $request, $id): JsonResponse
    {
        $merchant = User::where([
            ['id','=',$id],
            ['is_merchant','=',1],
        ])->first();

        $merchant->update($request->validated());
        $merchant->is_merchant   = 1;

        return response()->json([
            'id'            => (string) $merchant->id,
            'merchant_name' => $merchant->merchant_name,
            'address'       => $merchant->address,
            'email'         => $merchant->email,
            'category'      =>  $merchant->category,
            'image'         => $merchant->image,
            'description'   => $merchant->category,
        ]);
    }

    public function destroy(User $merchant)
    {
        $merchant->delete();
        return $this->noContent();
    }

    public function me() {
        return $this->success(auth()->user(), ProfileTransformer::class)->respond(JsonResponse::HTTP_OK);
    }

}
