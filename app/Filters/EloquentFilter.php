<?php
namespace App\Filters;

interface EloquentFilter
{
    public function filter(Filter $filter);
}
