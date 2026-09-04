<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Exceptions\ValidationException;
use Framework\Interfaces\MiddlewareInterface;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $exception) {
            http_response_code($exception->getCode());

            header('Content-Type: application/json');

            echo json_encode([
                'message' => $exception->getMessage(),
                'errors' => $exception->errors()
            ]);
        }
    }
}
