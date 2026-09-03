<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

readonly class Task
{
    public function __construct(
        private ?int $id = null,
        private int $categoryId,
        private int $createdByMemberId,
        private string $title,
        private ?string $description = null,
        private string $priority,
        private bool $isDone = false,
        private ?DateTimeImmutable $createdAt = null,
        private DateTimeImmutable $dueAt,
        private ?DateTimeImmutable $submittedAt = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getCreatedByMemberId(): int
    {
        return $this->createdByMemberId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDueAt(): DateTimeImmutable
    {
        return $this->dueAt;
    }

    public function getSubmittedAt(): ?DateTimeImmutable
    {
        return $this->submittedAt;
    }
}