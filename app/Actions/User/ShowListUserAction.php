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
    protected $userFilter;

    protected $userSort;

    public function __construct(UserFilter $userFilter, UserSort $userSort)
    {
        parent::__construct();
        $this->userFilter = $userFilter;
        $this->userSort = $userSort;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $user = User::query()
                    ->listUser()
                    ->filter($this->userFilter)
                    ->sortBy($this->userSort)
                    ->paginate($this->per_page);

        return $this->ok($user, UserTransformer::class);
    }
}
