<?php

declare(strict_types=1);

require_once APP_PATH . '/helpers/url_helper.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(($config['name'] ?? 'Maquina CTF'), ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars(($config['tagline'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/app.css'), ENT_QUOTES, 'UTF-8'); ?>">
</head>
<body>
    <div class="page-shell">
        <header class="site-header">
            <a class="brand" href="<?= htmlspecialchars(route(), ENT_QUOTES, 'UTF-8'); ?>">
                <span class="brand-mark">M</span>
                <span>
                    <strong><?= htmlspecialchars(($config['name'] ?? 'Maquina CTF'), ENT_QUOTES, 'UTF-8'); ?></strong>
                    <small><?= htmlspecialchars(($config['tagline'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></small>
                </span>
            </a>
            <nav class="site-nav">
                <a href="<?= htmlspecialchars(route(), ENT_QUOTES, 'UTF-8'); ?>">Inicio</a>
                <a href="<?= htmlspecialchars(route('retos'), ENT_QUOTES, 'UTF-8'); ?>">Retos</a>
                <a href="#arquitectura">Arquitectura</a>
            </nav>
        </header>
        <main class="site-main">
