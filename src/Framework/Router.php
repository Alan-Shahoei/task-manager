<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];

    public function add(string $path, string $method, array $action): void
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, " \n\r\t\v\0/");

        return preg_replace('#/{2,}#', '/', $path);
    }

    public function dispatch(string $path, string $method): void
    {
        $method = strtoupper($method);
        $path = $this->normalizePath($path);

        foreach ($this->routes as $route) {
            if (
                preg_match("#^{$route['path']}$#", $path)
                && $route['method'] === $method
            ) {
                [$class, $function] = $route['action'];
                $controllerInstance = new $class();
                $controllerInstance->$function();
                return;
            }
        }
    }
}