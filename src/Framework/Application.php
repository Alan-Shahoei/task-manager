<?php

declare(strict_types=1);

namespace Framework;

class Application
{
    private Router $router;
    private Container $container;

    public function __construct(?string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionsPath !== null) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, array $action): void
    {
        $this->router->add($path, 'GET', $action);
    }

    public function post(string $path, array $action): void
    {
        $this->router->add($path, 'POST', $action);
    }

    public function delete(string $path, array $action): void
    {
        $this->router->add($path, 'DELETE', $action);
    }

    public function patch(string $path, array $action): void
    {
        $this->router->add($path, 'PATCH', $action);
    }

    public function addMiddleware(string $middleware, array $except = []): void
    {
        $this->router->addMiddleware($middleware, $except);
    }
}