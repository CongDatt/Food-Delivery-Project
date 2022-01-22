<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Models\Shipper;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailShipperAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(Shipper $shipper): JsonResponse
    {
        return $this->ok($shipper, ShipperTransformer::class);
    }
}
