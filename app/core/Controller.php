<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function redirect(string $path = ''): void
    {
        $baseUrl = rtrim(Container::get('config')['base_url'] ?? '', '/');
        $location = $path === ''
            ? ($baseUrl !== '' ? $baseUrl : '/')
            : $baseUrl . '/' . ltrim($path, '/');

        header('Location: ' . $location);
        exit;
    }

    protected function requireAuth(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
    }
}
