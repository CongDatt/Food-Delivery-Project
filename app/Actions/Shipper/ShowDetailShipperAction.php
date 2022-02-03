<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Models\Shipper;
use App\Models\User;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;

class ShowDetailShipperAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(User $shipper): JsonResponse
    {
        return $this->ok($shipper, ShipperTransformer::class);
    }
}
