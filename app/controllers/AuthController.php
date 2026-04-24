<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

final class AuthController extends Controller
{
    public function login(): void
    {
        if (isset($_SESSION['user'])) {
            $this->redirect();
        }

        $this->view('auth/login');
    }

    public function authenticate(): void
    {
        $username = $this->input('username');
        $user = User::authenticate($username, $this->input('password'));

        if ($user === null) {
            $this->view('auth/login', [
                'error' => 'Usuario o contrasena incorrectos.',
                'username' => $username,
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user'] = $user;

        $this->redirect();
    }

    public function register(): void
    {
        if (isset($_SESSION['user'])) {
            $this->redirect();
        }

        $this->view('auth/register');
    }

    public function store(): void
    {
        $username = $this->input('username');
        $result = User::create($username, $this->input('password'));

        if (($result['ok'] ?? false) !== true) {
            $this->view('auth/register', [
                'error' => $result['message'] ?? 'No se pudo crear la cuenta.',
                'username' => $username,
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user'] = $result['user'];

        $this->redirect();
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);

        $this->redirect('login');
    }

    private function input(string $key): string
    {
        $value = $_POST[$key] ?? '';

        return is_string($value) ? $value : '';
    }
}
