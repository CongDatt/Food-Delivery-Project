<?php

namespace App\Transformers;

use App\Models\Merchant;
use Flugg\Responder\Transformers\Transformer;

class MerchantTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * @param Merchant $merchant
     * @return int[]
     */
    public function transform(Merchant $merchant)
    {
        return [
            'id' => (int) $merchant->id,
            'merchant_name' => (string) $merchant->merchant_name,
            'img_url' => (string) $merchant->image,
            'address' => (string) $merchant->address,
        ];
    }
}
