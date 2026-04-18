<?php

declare(strict_types=1);

use App\Core\Container;

function asset(string $path): string
{
    $baseUrl = rtrim(Container::get('config')['base_url'] ?? '', '/');

    return $baseUrl . '/public/' . ltrim($path, '/');
}

function route(string $path = ''): string
{
    $baseUrl = rtrim(Container::get('config')['base_url'] ?? '', '/');

    if ($path === '') {
        return $baseUrl !== '' ? $baseUrl : '/';
    }

    return $baseUrl . '/' . ltrim($path, '/');
}
