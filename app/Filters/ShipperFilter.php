<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Filters;

use App\Traits\CommonFilter;

class ShipperFilter extends Filter
{
    use CommonFilter;

    public function name($name)
    {
        return $this->query->whereLike('shipper_name', $name);
    }
}
