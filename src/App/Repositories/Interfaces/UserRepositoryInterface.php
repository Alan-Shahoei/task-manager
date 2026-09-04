<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(User $user): User;

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function existsByEmail(string $email): bool;

    public function update(User $user): bool;

    public function updatePassword(int $id, string $passwordHash): bool;

    public function delete(int $id): bool;
}