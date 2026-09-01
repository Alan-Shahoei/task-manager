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

    public function get(string $path, array $action): void
    {
        $this->router->add('GET', $path, $action);
    }
}