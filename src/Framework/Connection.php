<?php

declare(strict_types=1);

namespace Framework;

use PDO;
use PDOException;
use RuntimeException;

class Connection
{
    public static function make(): PDO
    {
        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s',
            $_ENV['DB_DRIVER'],
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_NAME']
        );

        try {
            return new PDO(
                $dsn,
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            throw new RuntimeException(
                'Unable to connect to database.'
            );
        }
    }
}