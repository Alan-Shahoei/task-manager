<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

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

    public function dispatch(string $path, string $method, Container $container = null): void
    {
        $method = strtoupper($method);
        $path = $this->normalizePath($path);

        foreach ($this->routes as $route) {
            if (
                preg_match("#^{$route['path']}$#", $path)
                && $route['method'] === $method
            ) {
                [$class, $function] = $route['action'];
                $controllerInstance = $container ? $container->resolve($class) : new $class();
                $action = fn() => $controllerInstance->$function();

                foreach ($this->middlewares as $middleware) {
                    $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware();
                    $action = fn() => $middlewareInstance->process($action);
                }

                $action();
                return;
            }
        }
    }

    public function addMiddleware(string $middleware): void
    {
        $this->middlewares[] = $middleware;
    }
}