<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Middleware\ValidationExceptionMiddleware;
use Framework\Application;
use Dotenv\Dotenv;

require __DIR__ . "/../../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$application = new Application(__DIR__ . "/container-definitions.php");

$application->get('/', [HomeController::class, 'index']);

$application->addMiddleware(ValidationExceptionMiddleware::class);

return $application;