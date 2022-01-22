<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Models\Shipper;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreateShipperAction extends BaseAction
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {

            $shipper = Shipper::create($data);

            return $this->ok($shipper, ShipperTransformer::class);
        });
    }
}
