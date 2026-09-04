<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Middleware\ValidationExceptionMiddleware;
use Framework\Application;

require __DIR__ . "/../../vendor/autoload.php";

$application = new Application(__DIR__ . "/container-definitions.php");

$application->get('/', [HomeController::class, 'index']);

$application->addMiddleware(ValidationExceptionMiddleware::class);

return $application;
