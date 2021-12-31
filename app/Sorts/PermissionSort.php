<?php


namespace App\Sorts;

use App\Sorts\Sort;
use App\Traits\CommonSort;

class PermissionSort extends Sort
{
    use CommonSort;

    public function name($direction)
    {
        return $this->query->orderBy('name', $direction);
    }
}
