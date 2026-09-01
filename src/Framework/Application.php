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

    function get(string $path)
    {
        $this->router->add('GET', $path);
    }
}