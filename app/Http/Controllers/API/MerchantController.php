<?php

namespace App\Http\Controllers\API;

use App\Actions\Merchant\ShowDetailMerchantAction;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;
use App\Actions\Merchant\ShowListMerchantAction;
use App\Actions\Merchant\CreateMerchantAction;
use App\Http\Requests\Merchant\CreateMerchantRequest;
use App\Http\Requests\Merchant\UpdateMerchantRequest;
use App\Actions\Merchant\UpdateMerchantAction;
use App\Actions\Merchant\DeleteMerchantAction;
use Psy\Util\Json;

class MerchantController extends ApiController
{
//    public function __construct()
//    {
//        $this->authorizeResource(Merchant::class);
//    }
    /**
     * @param ShowListMerchantAction $action
     * @return JsonResponse
     */
    public function index(ShowListMerchantAction $action):JsonResponse
    {
        return ($action)();
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateMerchantRequest $request
     * @param CreateMerchantAction $action
     * @return JsonResponse
     */
    public function store(CreateMerchantRequest $request, CreateMerchantAction $action)
    {
        return ($action)($request->validated());
    }

    /**
     * Display the specified resource.
     * @param Merchant $merchant
     * @param ShowDetailMerchantAction $action
     * @return JsonResponse
     */
    public function show(Merchant $merchant, ShowDetailMerchantAction $action): JsonResponse
    {
        return ($action) ($merchant);
    }

    /**
     *  Update the specified resource in storage.
     * @param UpdateMerchantRequest $request
     * @param Merchant $merchant
     * @param UpdateMerchantAction $action
     * @return JsonResponse
     */
    public function update(UpdateMerchantRequest $request, Merchant $merchant, UpdateMerchantAction $action): JsonResponse
    {
        return ($action) ($merchant, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param Merchant $merchant
     * @param DeleteMerchantAction $action
     * @return mixed
     */
    public function destroy(Merchant $merchant, DeleteMerchantAction $action)
    {
        return ($action) ($merchant);
    }
}
