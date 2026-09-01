<?php

declare(strict_types=1);

namespace Framework;

class Application
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method);
    }

    public function get(string $path, array $action): void
    {
        $this->router->add($path, 'GET', $action);
    }
}