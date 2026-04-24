<?php

declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';

$router = new App\Core\Router();

$router->get('/', [App\Controllers\HomeController::class, 'index']);
$router->get('/login', [App\Controllers\AuthController::class, 'login']);
$router->post('/login', [App\Controllers\AuthController::class, 'authenticate']);
$router->get('/registro', [App\Controllers\AuthController::class, 'register']);
$router->post('/registro', [App\Controllers\AuthController::class, 'store']);
$router->post('/logout', [App\Controllers\AuthController::class, 'logout']);
$router->get('/retos', [App\Controllers\ChallengeController::class, 'index']);
$router->get('/reto', [App\Controllers\ChallengeController::class, 'show']);
$router->post('/reto/verificar', [App\Controllers\ChallengeController::class, 'verify']);

$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
