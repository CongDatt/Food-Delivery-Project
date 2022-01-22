<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailMerchantAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(Merchant $merchant): JsonResponse
    {
        return $this->ok($merchant, MerchantTransformer::class);
    }
}
