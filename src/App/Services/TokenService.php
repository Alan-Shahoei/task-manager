<?php

declare(strict_types=1);

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

readonly class TokenService
{
    public function __construct(private string $secret, private int $expiration)
    {
    }

    public function generate(array $payload): string
    {
        $payload['iat'] = time();
        $payload['exp'] = time() + $this->expiration;

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function verify(string $token): array
    {
        $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
        return (array) $decoded;
    }
}