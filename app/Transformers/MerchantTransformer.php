<?php

namespace App\Transformers;

//use App\Models\Merchant;
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
//        'user'        => User::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
    ];
    /**
     * @param User $merchant
     * @return array
     */
    public function transform(User $merchant)
    {
        return [
            'id' => (int) $merchant->id,
            'merchant_name' => (string) $merchant->merchant_name,
            'address' => (string) $merchant->address,
            'email' => (string) $merchant->email,
            'category' => (string) $merchant->category,
            'image' => (string) $merchant->image,
            'description' => (string) $merchant->category,
        ];
    }
}
