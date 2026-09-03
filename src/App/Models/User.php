<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

class User
{
    public function __construct(
        private readonly ?int $id = null,
        private readonly string $name,
        private readonly string $email,
        private readonly string $passwordHash,
        private readonly string $profession,
        private readonly bool $isCeo = false,
        private readonly ?DateTimeImmutable $createdAt = null,
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