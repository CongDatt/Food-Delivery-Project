<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Filters\MerchantFilter;
use App\Models\Merchant;
use App\Sorts\MerchantSort;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;

class ShowListMerchantAction extends BaseAction
{
    protected $merchantFilter;

    protected $merchantSort;

    public function __construct(MerchantFilter $merchantFilter, MerchantSort $merchantSort)
    {
        parent::__construct();
        $this->merchantFilter = $merchantFilter;
        $this->merchantSort = $merchantSort;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $merchant = Merchant::query()
            ->filter($this->merchantFilter)
            ->sortBy($this->merchantSort)
            ->paginate($this->per_page);

        return $this->ok($merchant, MerchantTransformer::class);
    }
}
