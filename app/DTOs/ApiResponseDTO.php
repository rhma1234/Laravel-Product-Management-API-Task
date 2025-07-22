<?php

namespace App\DTOs;

class ApiResponse
{
    public function __construct(
        public ?array $message = [],
        public mixed $data = null,
    ) {}
}
