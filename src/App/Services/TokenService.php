<?php

declare(strict_types=1);

namespace App\Services;

readonly class TokenService
{
    public function __construct(private string $secret, private int $expiration)
    {
    }

    public function generate(array $payload): string
    {
        return '';
    }

    public function verify(string $token): array
    {
        return [];
    }
}