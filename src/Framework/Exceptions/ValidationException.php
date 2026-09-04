<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(
        private readonly array $errors,
        int $code = 422
    ) {
        parent::__construct('Validation failed', $code);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
