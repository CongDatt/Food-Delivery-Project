<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Filters\MerchantFilter;
use App\Models\Merchant;
use App\Sorts\MerchantSort;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowListMerchantAction extends BaseAction
{
    protected $merchantFilter;

    protected $merchantSort;

    public function __construct(MerchantFilter $merchantFilter, MerchantSort $merchantSort, Request $request)
    {
        parent::__construct();
        $this->merchantFilter = $merchantFilter;
        $this->merchantSort = $merchantSort;
        $this->q = $request->input('q');

    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $merchant = Merchant::where("merchant_name","like","%".$this->q."%")
            ->filter($this->merchantFilter)
            ->sortBy($this->merchantSort);

        return $this->ok($merchant, MerchantTransformer::class);
    }
}
