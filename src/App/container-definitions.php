<?php

declare(strict_types=1);

use App\Services\ValidatorService;
use Framework\Connection;

return [
    ValidatorService::class => fn() => new ValidatorService,
    PDO::class => fn() => Connection::make(),
];