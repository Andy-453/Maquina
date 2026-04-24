<?php

declare(strict_types=1);

require_once APP_PATH . '/helpers/url_helper.php';

$currentUser = $_SESSION['user'] ?? null;
$currentPoints = 0;

if ($currentUser !== null) {
    $progressKey = (string) ($currentUser['username'] ?? 'guest');
    $currentPoints = (int) ($_SESSION['challenge_progress'][$progressKey]['points'] ?? 0);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(($config['name'] ?? 'CTF REACH'), ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars(($config['tagline'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/app.css'), ENT_QUOTES, 'UTF-8'); ?>">
</head>
<body>
    <div class="page-shell">
        <header class="site-header">
            <a class="brand" href="<?= htmlspecialchars(route(), ENT_QUOTES, 'UTF-8'); ?>">
                <img
                    class="brand-mark"
                    src="<?= htmlspecialchars(asset('assets/img/Inicio.jpg'), ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?= htmlspecialchars(($config['name'] ?? 'CTF REACH'), ENT_QUOTES, 'UTF-8'); ?>"
                >
                <span>
                    <strong><?= htmlspecialchars(($config['name'] ?? 'CTF REACH'), ENT_QUOTES, 'UTF-8'); ?></strong>
                    <small><?= htmlspecialchars(($config['tagline'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></small>
                </span>
            </a>
            <nav class="site-nav">
                <?php if ($currentUser !== null): ?>
                    <a href="<?= htmlspecialchars(route(), ENT_QUOTES, 'UTF-8'); ?>">Inicio</a>
                    <a href="<?= htmlspecialchars(route('retos'), ENT_QUOTES, 'UTF-8'); ?>">Retos</a>
                    <span class="score-pill"><?= htmlspecialchars((string) $currentPoints, ENT_QUOTES, 'UTF-8'); ?> pts</span>
                    <span class="nav-user"><?= htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    <form class="nav-form" method="post" action="<?= htmlspecialchars(route('logout'), ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit">Salir</button>
                    </form>
                <?php else: ?>
                    <a href="<?= htmlspecialchars(route('login'), ENT_QUOTES, 'UTF-8'); ?>">Login</a>
                    <a href="<?= htmlspecialchars(route('registro'), ENT_QUOTES, 'UTF-8'); ?>">Registro</a>
                <?php endif; ?>
                <a href="#arquitectura">Arquitectura</a>
            </nav>
        </header>
        <main class="site-main">
