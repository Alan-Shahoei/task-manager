<?php

declare(strict_types=1);

use App\Services\ValidatorService;

return [
    ValidatorService::class => fn() => new ValidatorService
];