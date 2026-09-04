<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate(mixed $value, array $parameters = []): bool
    {
        return $value !== null && trim((string) $value) !== '';
    }

    public function getMessage(array $parameters = []): string
    {
        return 'This field is required';
    }
}
