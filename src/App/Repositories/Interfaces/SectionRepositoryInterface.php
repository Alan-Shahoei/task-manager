<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Section;

interface SectionRepositoryInterface
{
    public function create(string $name, string $color): Section;

    public function findById(int $id): ?Section;

    public function findAll(): array;

    public function update(int $id, string $name, string $color): bool;

    public function delete(int $id): bool;
}