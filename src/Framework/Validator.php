<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\ValidationException;
use Framework\Interfaces\RuleInterface;
use RuntimeException;

class Validator
{
    private array $rules = [];

    public function add(string $alias, RuleInterface $rule): void
    {
        $this->rules[$alias] = $rule;
    }

    public function validate(array $data, array $fields): void
    {
        $errors = [];

        foreach ($fields as $fieldName => $fieldRules) {
            foreach ($fieldRules as $rule) {
                [$alias, $parameters] = $this->parseRule($rule);

                if (!isset($this->rules[$alias])) {
                    throw new RuntimeException("Validation rule '{$alias}' is not registered");
                }

                $ruleValidator = $this->rules[$alias];
                $value = $data[$fieldName] ?? null;

                if (!$ruleValidator->validate($value, $parameters)) {
                    $errors[$fieldName][] = $ruleValidator->getMessage($parameters);
                }
            }
        }

        if ($errors) {
            throw new ValidationException($errors);
        }
    }

    private function parseRule(string $rule): array
    {
        $parts = explode(':', $rule, 2);

        $parameters = [];

        if (isset($parts[1])) {
            $parameters = explode(',', $parts[1]);
        }

        return [$parts[0], $parameters];
    }
}
