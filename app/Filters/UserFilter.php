<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Filters;

use App\Traits\CommonFilter;

class UserFilter extends Filter
{
    use CommonFilter;

    /**
     * Filter user by email
     *
     * @param string $email
     * @return \App\Builders\Builder
     */
    public function email($email)
    {
        return $this->query->whereLike('email', $email);
    }

    public function name($name)
    {
        return $this->query->whereLike('name', $name);
    }
}
