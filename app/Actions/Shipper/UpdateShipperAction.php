<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Models\Shipper;
use App\Transformers\SHipperTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UpdateShipperAction extends BaseAction
{
    public function __invoke(Shipper $shipper, array $data): JsonResponse
    {
        return DB::transaction(function () use ($shipper, $data) {
            $shipper->update($data);

            return $this->ok($shipper, ShipperTransformer::class);
        });
    }
}
