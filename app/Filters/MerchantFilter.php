<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Filters;

use App\Traits\CommonFilter;

class MerchantFilter extends Filter
{
    use CommonFilter;

    public function name($name)
    {
        return $this->query->whereLike('merchant_name', $name);
    }
}
