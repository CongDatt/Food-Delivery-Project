<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Filters\ShipperFilter;
use App\Models\Shipper;
use App\Models\User;
use App\Sorts\ShipperSort;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;

class ShowListShipperAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $shipper = User::where('is_shipper',1)->get();
        return $this->ok($shipper, ShipperTransformer::class);
    }
}
