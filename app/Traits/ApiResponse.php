<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    protected function success($data = null, string $message = '', int $status = Response::HTTP_OK): JsonResponse
    {
        // TODO: use DTOs
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function error(string $message = '', int $status = Response::HTTP_BAD_REQUEST, $errors = null): JsonResponse
    {
        // TODO: use DTOs

        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
