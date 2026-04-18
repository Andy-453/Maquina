<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Container;

final class Challenge
{
    public static function all(): array
    {
        return Container::get('retos', []);
    }

    public static function findBySlug(?string $slug): ?array
    {
        if ($slug === null || $slug === '') {
            return null;
        }

        foreach (self::all() as $challenge) {
            if ($challenge['slug'] === $slug) {
                return $challenge;
            }
        }

        return null;
    }
}
