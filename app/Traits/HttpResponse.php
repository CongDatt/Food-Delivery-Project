<?php

namespace App\Traits;

use Flugg\Responder\Http\MakesResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

trait HttpResponse {
    use MakesResponses;

    /**
     * @param null $data
     * @param null $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok($data = null, $transformer = null): JsonResponse
    {
        return $this->success($data, $transformer)->respond(JsonResponse::HTTP_OK);
    }

    /**
     * @param null $data
     * @param null $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function created($data = null, $transformer = null): JsonResponse
    {
        return $this->success($data, $transformer)->respond(JsonResponse::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent(): JsonResponse
    {
        return $this->success()->respond(JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Import errors
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function errorImport(array $errors = []): JsonResponse
    {
        $message = Arr::get($errors, 'message');
        $detail = Arr::get($errors, 'detail', []);

        return $this->errors(JsonResponse::HTTP_CONFLICT, $message, $detail);
    }

    /**
     * Errors
     *
     * @param $status
     * @param $error
     * @param $detail
     * @return JsonResponse
     */
    public function errors($status, $error, $detail): JsonResponse
    {
        $data = [
            'status'  => $status,
            'success' => false,
            'errors'  => [
                [
                    'error'  => $error,
                    'detail' => $detail,
                ],
            ],
        ];

        return response()->json($data, $status);
    }
}
