<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

readonly class Section
{
    public function __construct(
        private string $name,
        private string $color = '#3B82F6',
        private ?int $id = null,
        private ?DateTimeImmutable $createdAt = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
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