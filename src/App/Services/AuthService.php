<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use RuntimeException;

readonly class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private TokenService $tokenService
    )
    {
    }

    public function register(string $name, string $email, string $password, string $profession): User {
        if ($this->userRepository->existsByEmail($email)) {
            throw new RuntimeException('Email already exists');
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT );

        $user = new User(
            name: $name,
            email: $email,
            passwordHash: $passwordHash,
            profession: $profession
        );

        return $this->userRepository->create($user);
    }
}