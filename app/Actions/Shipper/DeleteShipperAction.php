<?php

namespace App\Actions\Shipper;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use App\Exceptions\DeleteRoleDefaulException;
use App\Models\Merchant;
use App\Models\Role;
use App\Models\Shipper;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DeleteShipperAction extends BaseAction
{
    public function __invoke(Shipper $shipper)
    {
        return DB::transaction(function () use ($shipper) {
            $shipper->delete();

            return $this->noContent();
        });
    }
}
