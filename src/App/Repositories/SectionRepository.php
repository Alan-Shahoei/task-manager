<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Section;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use PDO;

readonly class SectionRepository implements SectionRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(string $name, string $color): Section {
        $statement = $this->pdo->prepare(
            "INSERT INTO sections (name, color)
             VALUES (:name, :color)
             RETURNING *"
        );

        $statement->execute(['name' => $name, 'color' => $color]);

        return $this->mapToModel($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function findById(int $id): ?Section {
        $statement = $this->pdo->prepare("SELECT * FROM sections WHERE id = :id");

        $statement->execute(['id' => $id]);

        $section = $statement->fetch(PDO::FETCH_ASSOC);

        return $section ? $this->mapToModel($section) : null;
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM sections");

        $sections = [];

        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $section) {
            $sections[] = $this->mapToModel($section);
        }

        return $sections;
    }

    public function update(int $id, string $name, string $color): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE sections
             SET name = :name,
                 color = :color
             WHERE id = :id");

        return $statement->execute(['id' => $id, 'name' => $name, 'color' => $color]);
    }

    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM sections WHERE id = :id");

        return $statement->execute(['id' => $id]);
    }

    private function mapToModel(array $data): Section
    {
        return new Section($data['name'], $data['color'], (int) $data['id'], $data['created_at']);
    }
}