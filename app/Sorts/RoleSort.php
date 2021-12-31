<?php


namespace App\Sorts;

use App\Sorts\Sort;
use App\Traits\CommonSort;

class RoleSort extends Sort
{
    use CommonSort;

    public function name($direction)
    {
        return $this->query->orderBy('name', $direction);
    }
}
