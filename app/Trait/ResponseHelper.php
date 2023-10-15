<?php

namespace App\Trait;

use Illuminate\Http\Response;

trait ResponseHelper
{
    public function responseSucceed(array $data = [], $status_code = Response::HTTP_OK, string $message = 'Success')
    {
        $response =  $this->response(
            data: [
                ...$data,
                'status_code' => $status_code,
                'message' => $message ?? 'Success',
            ],
            code: $status_code
        );

        return $response;
    }

    public function responseValidationErrors(array $errors = [], string $message = null)
    {
        return $this->response(
            data: [
                ...$errors,
                'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $message ? $message : 'Validation error.',
            ],
            code: Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }

    public function responseUnauthroized(string $message = '', $code = Response::HTTP_FORBIDDEN)
    {
        return $this->response(
            data: [
                'message' => $message,
                'status_code' => $code
            ],
            code: $code
        );
    }

    private function response(array $data, int $code)
    {
        return response()->json(
            $data,
            $code,
        );
    }

    public function responseCollection(mixed $data)
    {
        return response()->json($data, 200);
    }
}
