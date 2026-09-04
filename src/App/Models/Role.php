<?php

namespace App\Models;

readonly class Role
{
    public function __construct(
        private string $name,
        private ?int $id = null
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
}