<?php

namespace App\Traits;

use App\DTOs\ApiResponseDTO;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    protected function success(mixed $data = null, string $message = '', int $status = Response::HTTP_OK): JsonResponse
    {
        $response = new ApiResponseDTO($message, $data);

        return response()->json($response, $status);
    }

    protected function error(string $message = '', int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {

        $response = new ApiResponseDTO($message, null);

        return response()->json($response, $status);
    }
}
