<?php

declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';

$router = new App\Core\Router();

$router->get('/', [App\Controllers\HomeController::class, 'index']);
$router->get('/retos', [App\Controllers\ChallengeController::class, 'index']);
$router->get('/reto', [App\Controllers\ChallengeController::class, 'show']);

$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
