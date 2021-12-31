<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait HandleErrorException {
    use  HttpResponse;

    /**
     * @param ValidationException $exception
     * @return JsonResponse
     */
    public function validationError(ValidationException $exception): JsonResponse
    {
        $data = [
            'status'  => JsonResponse::HTTP_BAD_REQUEST,
            'success' => false,
            'errors'  => $this->convertErrors($exception->errors()),
        ];

        return response()->json($data, JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @return JsonResponse
     */
    public function unauthorized(): JsonResponse
    {
        return $this->errors(JsonResponse::HTTP_UNAUTHORIZED, trans('message.err_401'), trans('message.detail_401'));
    }

    /**
     * @return JsonResponse
     */
    public function forbidden(): JsonResponse
    {
        return $this->errors(JsonResponse::HTTP_FORBIDDEN, trans('message.err_403'), trans('message.detail_403'));
    }

    /**
     * @return JsonResponse
     */
    public function notFound(): JsonResponse
    {
        return $this->errors(JsonResponse::HTTP_NOT_FOUND, trans('message.err_404'), trans('message.detail_404'));
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function serverError($message): JsonResponse
    {
        return $this->errors(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, trans('message.err_500'), $message);
    }

    /**
     * @param $errors
     * @return array
     */
    private function convertErrors($errors): array
    {
        $result = [];
        foreach ($errors as $k => $error) {
            $result[] = [
                'field'  => $k,
                'error'  => trans('message.err_validation'),
                'detail' => last($error),
            ];
        }

        return $result;
    }
}
