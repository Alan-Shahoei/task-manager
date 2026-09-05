<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\SectionMember;
use App\Repositories\Interfaces\SectionMemberRepositoryInterface;
use PDO;

readonly class SectionMemberRepository implements SectionMemberRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(SectionMember $sectionMember): SectionMember
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO section_members (user_id, role_id, section_id)
            VALUES (:user_id,:role_id,:section_id)
            RETURNING *'
        );

        $statement->execute([
            'user_id' => $sectionMember->getUserId(),
            'role_id' => $sectionMember->getRoleId(),
            'section_id' => $sectionMember->getSectionId()
        ]);

        return $this->mapToSectionMember($statement->fetch(PDO::FETCH_ASSOC));
    }


    public function findById(int $id): ?SectionMember
    {
        $statement = $this->pdo->prepare('SELECT * FROM section_members WHERE id = :id');

        $statement->execute(['id' => $id]);

        $sectionMember = $statement->fetch(PDO::FETCH_ASSOC);

        return $sectionMember
            ? $this->mapToSectionMember($sectionMember)
            : null;
    }


    public function findByUserAndSection(int $userId, int $sectionId): array
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM section_members
             WHERE user_id = :user_id AND section_id = :section_id'
        );

        $statement->execute(['user_id' => $userId, 'section_id' => $sectionId]);

        return array_map(
            fn(array $data) => $this->mapToSectionMember($data),
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }


    public function findByUserId(int $userId): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM section_members WHERE user_id = :user_id');

        $statement->execute(['user_id' => $userId]);

        return array_map(
            fn(array $data) => $this->mapToSectionMember($data),
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }


    public function findBySectionId(int $sectionId): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM section_members WHERE section_id = :section_id');

        $statement->execute(['section_id' => $sectionId]);

        return array_map(
            fn(array $data) => $this->mapToSectionMember($data),
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }


    public function hasRole(int $userId, int $sectionId, int $roleId): bool
    {
        $statement = $this->pdo->prepare(
            'SELECT EXISTS(
                SELECT 1
                FROM section_members
                WHERE user_id = :user_id
                AND section_id = :section_id
                AND role_id = :role_id
            )'
        );

        $statement->execute([
            'user_id' => $userId,
            'section_id' => $sectionId,
            'role_id' => $roleId
        ]);

        return (bool) $statement->fetchColumn();
    }


    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM section_members WHERE id = :id');

        return $statement->execute(['id' => $id]);
    }


    private function mapToSectionMember(array $data): SectionMember
    {
        return new SectionMember(
            (int) $data['user_id'],
            (int) $data['role_id'],
            (int) $data['section_id'],
            (int) $data['id']
        );
    }
}