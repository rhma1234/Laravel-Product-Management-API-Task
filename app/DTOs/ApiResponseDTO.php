<?php

namespace App\DTOs;

class ApiResponseDTO
{
    public function __construct(public array|string $message = [], public mixed $data = null)
    {
        $this->message = is_array($message) ? $message : [$message];
    }
}
