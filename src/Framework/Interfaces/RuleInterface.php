<?php

declare(strict_types=1);

namespace Framework\Interfaces;

interface RuleInterface
{
    public function validate(mixed $value, array $parameters = []): bool;

    public function getMessage(array $parameters = []): string;
}
