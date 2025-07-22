<?php

namespace App\DTOs;

class ApiResponseDTO
{
    public function __construct(
        // public ?array $message = [],
        public string $message = '',
        public mixed $data = null,
    ) {}
}
