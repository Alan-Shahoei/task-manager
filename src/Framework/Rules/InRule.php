<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RuleInterface;

class InRule implements RuleInterface
{
    public function validate(mixed $value, array $parameters = []): bool
    {
        return in_array($value, $parameters, true);
    }

    public function getMessage(array $parameters = []): string
    {
        return 'The selected value is invalid';
    }
}
