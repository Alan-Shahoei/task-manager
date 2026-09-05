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
                    if (in_array($path, $middleware['except'])) {
                        continue;
                    }

                    $middlewareClass = $middleware['middleware'];

                    $middlewareInstance = $container ? $container->resolve($middlewareClass) : new $middlewareClass();

                    $action = fn() => $middlewareInstance->process($action);
                }

                $action();
                return;
            }
        }
    }

    public function addMiddleware(string $middleware, array $except = []): void
    {
        $this->middlewares[] = [
            'middleware' => $middleware,
            'except' => $except
        ];
    }
}