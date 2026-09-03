<?php

declare(strict_types=1);

namespace App\Models;

readonly class SectionMember
{
    public function __construct(
        private ?int $id = null,
        private int $userId,
        private int $roleId,
        private int $sectionId
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

}