<?php

namespace App\Actions\User;

use App\Actions\BaseAction;
use App\Filters\UserFilter;
use App\Models\User;
use App\Services\VietNamProvincesService;
use App\Sorts\UserSort;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;

class ShowListUserAction extends BaseAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $user = User::query()
            ->where([
                ['name','<>','admin'],
                ['is_shipper','<>','1'],
                ['is_merchant','<>','1'],
            ])->get();

        return $this->ok($user, UserTransformer::class);
    }
}
