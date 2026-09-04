<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\RequiredRule;
use Framework\Rules\EmailRule;
use Framework\Rules\MinRule;
use Framework\Rules\MaxRule;
use Framework\Rules\InRule;
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->registerRules();
    }

    public function validate(array $data, array $rules): void
    {
        $this->validator->validate($data, $rules);
    }

    private function registerRules(): void
    {
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
        $this->validator->add('max', new MaxRule());
        $this->validator->add('in', new InRule());
    }
}
