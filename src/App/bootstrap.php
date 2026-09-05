<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;
use App\Middleware\ValidationExceptionMiddleware;
use Framework\Application;
use Dotenv\Dotenv;

require __DIR__ . "/../../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$application = new Application(__DIR__ . "/container-definitions.php");

$application->get('/', [HomeController::class, 'index']);
$application->get('/profile', [UserController::class, 'profile']);
$application->post('/register', [AuthController::class, 'register']);
$application->post('/login', [AuthController::class, 'login']);

$application->addMiddleware(ValidationExceptionMiddleware::class);
$application->addMiddleware(AuthMiddleware::class, ['/login', '/register']);

return $application;