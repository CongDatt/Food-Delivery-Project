<?php

namespace App\Actions\Dish;

use App\Actions\BaseAction;
use App\Enums\RoleType;
use App\Models\Dish;
use App\Exceptions\DeleteRoleDefaulException;
use App\Models\Merchant;
use App\Models\Role;
use App\Transformers\MerchantTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DeleteDishAction extends BaseAction
{
    public function __invoke(Dish $dish)
    {
        return DB::transaction(function () use ($dish) {
            $dish->delete();

            return $this->noContent();
        });
    }
}
