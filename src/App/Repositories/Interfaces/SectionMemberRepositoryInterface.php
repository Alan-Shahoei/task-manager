<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\SectionMember;

interface SectionMemberRepositoryInterface
{
    public function create(SectionMember $sectionMember): SectionMember;

    public function findById(int $id): ?SectionMember;

    public function findByUserAndSection(int $userId, int $sectionId): array;

    public function findByUserId(int $userId): array;

    public function findBySectionId(int $sectionId): array;

    public function isMember(int $userId, int $sectionId): bool;

    public function hasRole(int $userId, int $sectionId, int $roleId): bool;

    public function delete(int $id): bool;
}