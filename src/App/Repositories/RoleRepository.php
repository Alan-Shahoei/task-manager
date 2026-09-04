<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use PDO;

readonly class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findById(int $id): ?Role
    {
        $statement = $this->pdo->prepare('SELECT * FROM roles WHERE id = :id');

        $statement->execute(['id' => $id]);

        $role = $statement->fetch(PDO::FETCH_ASSOC);

        return $role
            ? $this->mapToRole($role)
            : null;
    }

    public function findByName(string $name): ?Role
    {
        $statement = $this->pdo->prepare('SELECT * FROM roles WHERE name = :name');

        $statement->execute(['name' => $name]);

        $role = $statement->fetch(PDO::FETCH_ASSOC);

        return $role
            ? $this->mapToRole($role)
            : null;
    }

    private function mapToRole(array $data): Role
    {
        return new Role(id: (int) $data['id'], name: $data['name']);
    }
}