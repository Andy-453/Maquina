<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('STORAGE_PATH', BASE_PATH . '/storage');

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = APP_PATH . '/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

$appConfig = require APP_PATH . '/config/app.php';
$challengeConfig = require APP_PATH . '/config/retos.php';

date_default_timezone_set($appConfig['timezone']);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name($appConfig['session_name']);
    session_start();
}

App\Core\Container::set('config', $appConfig);
App\Core\Container::set('retos', $challengeConfig);
