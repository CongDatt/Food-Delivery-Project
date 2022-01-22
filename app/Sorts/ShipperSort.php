<?php


namespace App\Sorts;

use App\Sorts\Sort;
use App\Traits\CommonSort;

class ShipperSort extends Sort
{
    use CommonSort;

    public function name($direction)
    {
        return $this->query->orderBy('shipper_name', $direction);
    }
}
