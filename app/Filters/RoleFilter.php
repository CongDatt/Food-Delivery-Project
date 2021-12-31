<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Filters;

use App\Traits\CommonFilter;

class RoleFilter extends Filter
{
    use CommonFilter;

    public function name($name)
    {
        return $this->query->whereLike('name', $name);
    }
}
