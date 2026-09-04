<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Framework\Connection;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $pdo = Connection::make();

    $schema = file_get_contents(__DIR__ . '/database/schema.sql');

    $pdo->exec($schema);

    echo "Database schema created successfully.\n";

} catch (PDOException $e) {
    echo "Database setup failed.\n";
}