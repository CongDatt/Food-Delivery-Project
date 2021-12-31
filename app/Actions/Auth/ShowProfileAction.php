<?php

namespace App\Actions\Auth;

use App\Traits\HttpResponse;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\JsonResponse;

class ShowProfileAction
{
    use HttpResponse;

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->success(auth()->user(), ProfileTransformer::class)->respond(JsonResponse::HTTP_OK);
    }
}
