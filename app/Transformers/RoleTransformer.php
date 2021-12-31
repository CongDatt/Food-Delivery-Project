<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Spatie\Permission\Models\Role;

class RoleTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'permissions' => PermissionTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param Role $role
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'id'           => $role->id,
            'name'         => (string) $role->name,
            'display_name' => (string) $role->display_name,
        ];
    }
}
