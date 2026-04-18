<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): void
    {
        $config = Container::get('config', []);
        extract($data, EXTR_SKIP);

        $viewFile = APP_PATH . '/views/' . $view . '.php';

        if (!is_file($viewFile)) {
            throw new \RuntimeException('Vista no encontrada: ' . $view);
        }

        require APP_PATH . '/views/layout/header.php';
        require $viewFile;
        require APP_PATH . '/views/layout/footer.php';
    }
}
