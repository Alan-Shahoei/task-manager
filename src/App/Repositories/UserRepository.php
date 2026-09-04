<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use DateTimeImmutable;
use PDO;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public function create(User $user): User
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO users (name,email,password_hash,profession,is_ceo)
            VALUES (:name,:email,:password_hash,:profession,:is_ceo)
            RETURNING *'
        );

        $statement->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password_hash' => $user->getPasswordHash(),
            'profession' => $user->getProfession(),
            'is_ceo' => $user->isCeo()
        ]);

        return $this->mapToUser($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function findById(int $id): ?User
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');

        $statement->execute(['id' => $id]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ? $this->mapToUser($user) : null;
    }


    public function findByEmail(string $email): ?User
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');

        $statement->execute(['email' => $email]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ? $this->mapToUser($user) : null;
    }


    public function existsByEmail(string $email): bool
    {
        $statement = $this->pdo->prepare('SELECT EXISTS(SELECT 1 FROM users WHERE email = :email)');

        $statement->execute(['email' => $email]);

        return (bool) $statement->fetchColumn();
    }


    public function update(User $user): bool
    {
        $statement = $this->pdo->prepare(
            'UPDATE users
             SET name = :name, email = :email, profession = :profession
             WHERE id = :id'
        );

        return $statement->execute([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'profession' => $user->getProfession()
        ]);
    }


    public function updatePassword(int $id, string $passwordHash): bool
    {
        $statement = $this->pdo->prepare(
            'UPDATE users
             SET password_hash = :password_hash
             WHERE id = :id'
        );

        return $statement->execute(['id' => $id, 'password_hash' => $passwordHash]);
    }


    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM users WHERE id = :id');

        return $statement->execute(['id' => $id]);
    }


    private function mapToUser(array $data): User
    {
        return new User(
            id: (int) $data['id'],
            name: $data['name'],
            email: $data['email'],
            passwordHash: $data['password_hash'],
            profession: $data['profession'],
            isCeo: (bool) $data['is_ceo'],
            createdAt: new DateTimeImmutable($data['created_at'])
        );
    }
}