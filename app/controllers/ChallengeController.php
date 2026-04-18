<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Challenge;

final class ChallengeController extends Controller
{
    public function index(): void
    {
        $this->view('retos/index', [
            'retos' => Challenge::all(),
        ]);
    }

    public function show(): void
    {
        $slug = $_GET['slug'] ?? null;
        $reto = Challenge::findBySlug($slug);

        if ($reto === null) {
            http_response_code(404);
            $this->view('layout/404', ['path' => '/reto?slug=' . (string) $slug]);
            return;
        }

        $this->view('retos/show', ['reto' => $reto]);
    }
}
