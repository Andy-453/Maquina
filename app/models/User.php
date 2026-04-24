<?php

declare(strict_types=1);

namespace App\Models;

final class User
{
    public static function create(string $username, string $password): array
    {
        $username = self::normalizeUsername($username);

        if ($username === '' || strlen($password) < 4) {
            return ['ok' => false, 'message' => 'Ingresa un usuario y una contrasena de minimo 4 caracteres.'];
        }

        $users = self::all();

        if (isset($users[$username])) {
            return ['ok' => false, 'message' => 'Ese usuario ya existe.'];
        }

        $users[$username] = [
            'username' => $username,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('c'),
        ];

        self::save($users);

        return ['ok' => true, 'user' => ['username' => $username]];
    }

    public static function authenticate(string $username, string $password): ?array
    {
        $username = self::normalizeUsername($username);
        $users = self::all();
        $user = $users[$username] ?? null;

        if ($user === null || !password_verify($password, $user['password_hash'] ?? '')) {
            return null;
        }

        return ['username' => $username];
    }

    private static function all(): array
    {
        $path = self::path();

        if (!is_file($path)) {
            return [];
        }

        $contents = file_get_contents($path);
        $users = json_decode($contents !== false ? $contents : '', true);

        return is_array($users) ? $users : [];
    }

    private static function save(array $users): void
    {
        $path = self::path();
        $directory = dirname($path);

        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT), LOCK_EX);
    }

    private static function path(): string
    {
        return STORAGE_PATH . '/users.json';
    }

    private static function normalizeUsername(string $username): string
    {
        return strtolower(trim($username));
    }
}
