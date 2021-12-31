<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Spatie\Permission\Models\Permission;

class PermissionTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'roles' => RoleTransformer::class
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
     * @param \Spatie\Permission\Models\Permission $permission
     * @return array
     */
    public function transform(Permission $permission)
    {
        return [
            'id'           => $permission->id,
            'name'         => (string) $permission->name,
            'display_name' => (string) $permission->display_name,
        ];
    }
}
