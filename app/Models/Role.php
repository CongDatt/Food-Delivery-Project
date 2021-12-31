<?php

namespace App\Models;

use App\Builders\RoleBuilder;
use App\Traits\OverridesBuilder;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return RoleBuilder::class;
    }

    protected $fillable = [
        'guard_name', 'name', 'display_name'
    ];
}
