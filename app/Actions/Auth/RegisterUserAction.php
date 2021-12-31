<?php


namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Transformers\UserTransformer;

class RegisterUserAction extends BaseAction
{
    /**
     * @param $data
     * @return JsonResponse
     */
    public function __invoke($data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $user = User::create($data);

            return $this->created($user, UserTransformer::class);
        });
    }

}
