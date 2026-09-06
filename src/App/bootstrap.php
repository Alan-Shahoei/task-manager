<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\SectionController;
use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CeoMiddleware;
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

$application->post('/section', [SectionController::class, 'create'], [CeoMiddleware::class]);
$application->get('/section', [SectionController::class, 'index'], [CeoMiddleware::class]);
$application->get('/section/{id}', [SectionController::class, 'show'], [CeoMiddleware::class]);
$application->patch('/section/{id}', [SectionController::class, 'update'], [CeoMiddleware::class]);
$application->delete('/section/{id}', [SectionController::class, 'delete'], [CeoMiddleware::class]);
$application->get('/userSection/{userId}', [SectionController::class, 'userSections']);


$application->addMiddleware(ValidationExceptionMiddleware::class);
$application->addMiddleware(AuthMiddleware::class, ['/login', '/register']);

return $application;