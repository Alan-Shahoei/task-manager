<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function add(string $path, string $method, array $action, array $routMiddlewares): void
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action,
            'middleware' => $routMiddlewares
        ];
    }

    public function addMiddleware(string $middleware, array $except = []): void
    {
        $this->middlewares[] = [
            'middleware' => $middleware,
            'except' => $except
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
            if ($route['method'] !== $method) {
                continue;
            }

            $params = $this->matchRoute($route['path'], $path);

            if ($params === null) {
                continue;
            }

            [$class, $function] = $route['action'];

            $controllerInstance = $container ? $container->resolve($class) : new $class();


            $action = fn() => $controllerInstance->$function(...$params);


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

    private function compileRoute(string $path): string
    {
        $pattern = preg_replace(
            '/\{([a-zA-Z0-9_]*)\}/',
            '(?P<$1>[^/]+)',
            $path
        );

        return '#^' . $pattern . '$#';
    }

    private function matchRoute(string $routePath, string $requestPath): ?array
    {
        $pattern = $this->compileRoute($routePath);

        if (!preg_match($pattern, $requestPath, $matches)) {
            return null;
        }

        return array_filter(
            $matches,
            fn($key) => is_string($key),
            ARRAY_FILTER_USE_KEY
        );
    }
}