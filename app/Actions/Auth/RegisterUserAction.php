<?php


namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Transformers\UserTransformer;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterUserAction extends BaseAction
{
    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function __invoke($data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $user = User::create($data);
            $createdUser = $this->auth->createUser($data);

            return $this->created($user, UserTransformer::class);
        });
    }

}
