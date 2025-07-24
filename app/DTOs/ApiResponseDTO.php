<?php

namespace App\DTOs;

class ApiResponseDTO
{
    public function __construct(
        // TODO:
        // - $messages must be string or array
        // - if passing sting convert it to array
        public array | string $message = [],
        public mixed $data = null,
    ) {}
}
