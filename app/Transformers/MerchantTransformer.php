<?php

namespace App\Transformers;

use App\Models\Merchant;
use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class MerchantTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'user'        => User::class,

    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
    ];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Merchant $merchant
     * @return array
     */
    public function transform(Merchant $merchant)
    {
        return [
            'id' => (int) $merchant->id,
            'name' => (string) $merchant->user->email,
        ];
    }
}
