<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];

    function add(string $method, string $path, array $action): void
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'action' => $action
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, " \n\r\t\v\0/");

        return preg_replace('#/{2,}#', '/', $path);
    }
}