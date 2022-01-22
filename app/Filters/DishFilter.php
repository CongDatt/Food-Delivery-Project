<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Filters;

use App\Traits\CommonFilter;

class DishFilter extends Filter
{
    use CommonFilter;

    public function name($name)
    {
        return $this->query->whereLike('merchant_id', $name);
    }
}
