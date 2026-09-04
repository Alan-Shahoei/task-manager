<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RuleInterface;

class MinRule implements RuleInterface
{
    public function validate(mixed $value, array $parameters = []): bool
    {
        $min = (int) ($parameters[0] ?? 0);

        return is_string($value) && mb_strlen($value) >= $min;
    }

    public function getMessage(array $parameters = []): string
    {
        return "This field must be at least {$parameters[0]} characters";
    }
}
