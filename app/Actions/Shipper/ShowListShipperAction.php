<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Filters\ShipperFilter;
use App\Models\Shipper;
use App\Sorts\ShipperSort;
use App\Transformers\ShipperTransformer;
use Illuminate\Http\JsonResponse;

class ShowListShipperAction extends BaseAction
{
    protected $shipperFilter;

    protected $shipperSort;

    public function __construct(ShipperFilter $shipperFilter, ShipperSort $shipperSort)
    {
        parent::__construct();
        $this->shipperFilter = $shipperFilter;
        $this->shipperSort = $shipperSort;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $shipper = Shipper::query()
            ->filter($this->shipperFilter)
            ->sortBy($this->shipperSort);

        return $this->ok($shipper, ShipperTransformer::class);
    }
}
