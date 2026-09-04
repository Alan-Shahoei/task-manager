<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RuleInterface;

class MaxRule implements RuleInterface
{
    public function validate(mixed $value, array $parameters = []): bool
    {
        $max = (int) ($parameters[0] ?? 0);

        return is_string($value) && mb_strlen($value) <= $max;
    }

    public function getMessage(array $parameters = []): string
    {
        return "This field must not exceed {$parameters[0]} characters";
    }
}
