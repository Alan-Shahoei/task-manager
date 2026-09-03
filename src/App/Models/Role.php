<?php

namespace App\Models;

readonly class Role
{
    public function __construct(
        private ?int $id = null,
        private string $name
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