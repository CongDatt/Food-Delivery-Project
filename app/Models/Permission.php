<?php

namespace App\Models;

use App\Builders\PermissionBuilder;
use App\Traits\OverridesBuilder;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return PermissionBuilder::class;
    }

    protected $fillable = [
        'guard_name', 'name', 'display_name'
    ];
}
