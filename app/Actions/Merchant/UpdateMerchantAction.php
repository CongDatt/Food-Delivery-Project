<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Models\Merchant;
use App\Models\Role;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateMerchantAction extends BaseAction
{
    public function __invoke(Merchant $merchant, array $data): JsonResponse
    {
        return DB::transaction(function () use ($merchant, $data) {
            $merchant->update($data);

            return $this->ok($merchant, MerchantTransformer::class);
        });
    }
}
