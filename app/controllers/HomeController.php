<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Challenge;

final class HomeController extends Controller
{
    public function index(): void
    {
        $retos = Challenge::all();

        $stats = [
            'total' => count($retos),
            'categorias' => count(array_unique(array_column($retos, 'categoria'))),
            'puntaje' => array_sum(array_column($retos, 'puntaje')),
        ];

        $this->view('home/index', [
            'stats' => $stats,
            'retos' => array_slice($retos, 0, 4),
        ]);
    }
}
