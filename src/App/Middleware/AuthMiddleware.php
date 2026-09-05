<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Auth\CurrentUser;
use App\Services\TokenService;
use Framework\Interfaces\MiddlewareInterface;
use Framework\Response;
use Throwable;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private TokenService $tokenService, private CurrentUser $currentUser)
    {
    }

    public function process(callable $next): void
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!str_starts_with($header, 'Bearer ')) {
            Response::json(['message' => 'Unauthorized'], 401);
            return;
        }

        $token = substr($header, 7);

        try {
            $payload = $this->tokenService->verify($token);
            $this->currentUser->setId($payload['user_id']);
            $next();
        } catch (Throwable $exception) {
            Response::json(['message' => 'Invalid token'], 401);
        }
    }
}