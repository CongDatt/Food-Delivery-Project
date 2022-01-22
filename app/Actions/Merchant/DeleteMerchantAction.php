<?php

namespace App\Actions\Merchant;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use App\Exceptions\DeleteRoleDefaulException;
use App\Models\Merchant;
use App\Models\Role;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DeleteMerchantAction extends BaseAction
{
    public function __invoke(Merchant $merchant)
    {
        return DB::transaction(function () use ($merchant) {
            $merchant->delete();

            return $this->noContent();
        });
    }
}
