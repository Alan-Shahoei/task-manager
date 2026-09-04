<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RuleInterface;

class EmailRule implements RuleInterface
{
    public function validate(mixed $value, array $parameters = []): bool
    {
        return is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getMessage(array $parameters = []): string
    {
        return 'This field must be a valid email address';
    }
}
