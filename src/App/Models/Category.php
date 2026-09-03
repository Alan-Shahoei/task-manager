<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

readonly class Category
{
    public function __construct(
        private ?int $id = null,
        private int $sectionId,
        private string $name,
        private ?string $description = null,
        private string $color = '#10B981',
        private ?DateTimeImmutable $createdAt = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSectionId(): int
    {
        return $this->sectionId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }
}