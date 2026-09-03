<?php

namespace Framework\Interfaces;

interface MiddlewareInterface
{
    public function process(callable $next);
}