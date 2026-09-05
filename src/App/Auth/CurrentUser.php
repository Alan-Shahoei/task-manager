<?php

declare(strict_types=1);

namespace App\Auth;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use RuntimeException;

class CurrentUser
{
    private ?int $userId = null;
    private ?User $user = null;

    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function setId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function get(): User
    {
        if (!$this->user) {
            if (!$this->userId) {
                throw new RuntimeException('Current user is not set');
            }

            $this->user = $this->userRepository->findById($this->userId);

            if (!$this->user) {
                throw new RuntimeException('User not found');
            }
        }

        return $this->user;
    }

    public function isAuthenticated(): bool
    {
        return $this->userId !== null;
    }
}