<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

readonly class User
{
    public function __construct(
        private string $name,
        private string $email,
        private string $passwordHash,
        private string $profession,
        private bool $isCeo = false,
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getProfession(): string
    {
        return $this->profession;
    }

    public function isCeo(): bool
    {
        return $this->isCeo;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }
}