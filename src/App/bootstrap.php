<?php

declare(strict_types=1);

use Controllers\HomeController;
use Framework\Application;

require __DIR__ . "/../../vendor/autoload.php";

$application = new Application();

$application->get('/', [HomeController::class, 'index']);

return $application;
