<?php

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class ProfileTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'roles'       => RoleTransformer::class,
        'permissions' => PermissionTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'roles'       => RoleTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @param \App\Models\User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'    => (string)$user->id,
            'name'  => (string) $user->name,
            'email' => (string) $user->email,
            'is_merchant' => (string) $user->is_merchant,
            'is_shipper' => (string) $user->is_shipper,
            'phone' => (string) $user->phone,
            'customer_name' => (string) $user->customer_name,
        ];
    }
}
