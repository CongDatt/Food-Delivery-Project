<?php


namespace App\Sorts;

use App\Sorts\Sort;
use App\Traits\CommonSort;

class MerchantSort extends Sort
{
    use CommonSort;

    public function name($direction)
    {
        return $this->query->orderBy('merchant_name', $direction);
    }
}
