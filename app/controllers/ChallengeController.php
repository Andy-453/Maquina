<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Challenge;

final class ChallengeController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();

        $retos = Challenge::all();
        foreach ($retos as &$reto) {
            $reto['isCompleted'] = $this->isCompleted($reto['slug']);
        }

        $this->view('retos/index', [
            'retos' => $retos,
        ]);
    }

    public function show(): void
    {
        $this->requireAuth();

        $slug = $_GET['slug'] ?? null;
        $reto = Challenge::findBySlug($slug);

        if ($reto === null) {
            http_response_code(404);
            $this->view('layout/404', ['path' => '/reto?slug=' . (string) $slug]);
            return;
        }

        $this->view('retos/show', [
            'reto' => $reto,
            'nextReto' => $this->findNextChallenge((int) $reto['numero']),
            'flagResult' => $_SESSION['flag_result'] ?? null,
            'answerResult' => $_SESSION['answer_result'] ?? null,
            'isCompleted' => $this->isCompleted($reto['slug']),
            'totalPoints' => $this->currentPoints(),
        ]);

        unset($_SESSION['flag_result']);
        unset($_SESSION['answer_result']);
    }

    public function verifyAnswer(): void
    {
        $this->requireAuth();

        $slug = trim((string) ($_POST['slug'] ?? ''));
        $answer = trim((string) ($_POST['answer'] ?? ''));
        $reto = Challenge::findBySlug($slug);

        if ($reto === null) {
            http_response_code(404);
            $this->view('layout/404', ['path' => '/reto?slug=' . $slug]);
            return;
        }

        $validator = $this->validatorFor($reto);
        $flag = (string) ($validator['flag'] ?? $validator['flag_format'] ?? '');

        if ($this->isValidAnswer($validator, $answer) && $flag !== '') {
            $_SESSION['answer_result'] = [
                'type' => 'success',
                'message' => 'Tu flag es: ' . $flag,
            ];
        } else {
            $_SESSION['answer_result'] = [
                'type' => 'error',
                'message' => 'Revisa el resultado del escaneo.',
            ];
        }

        $this->redirect('reto?slug=' . $slug);
    }

    public function verify(): void
    {
        $this->requireAuth();

        $slug = trim((string) ($_POST['slug'] ?? ''));
        $submittedFlag = trim((string) ($_POST['flag'] ?? ''));
        $reto = Challenge::findBySlug($slug);

        if ($reto === null) {
            http_response_code(404);
            $this->view('layout/404', ['path' => '/reto?slug=' . $slug]);
            return;
        }

        if ($this->isValidFlag($reto, $submittedFlag)) {
            $alreadyCompleted = $this->isCompleted($reto['slug']);

            if (!$alreadyCompleted) {
                $this->markCompleted($reto);
            }

            $_SESSION['flag_result'] = [
                'type' => 'success',
                'message' => $alreadyCompleted
                    ? 'Este reto ya estaba completado.'
                    : 'Se sumaron ' . (int) $reto['puntaje'] . ' puntos.',
            ];
        } else {
            $_SESSION['flag_result'] = [
                'type' => 'error',
                'message' => 'Flag incorrecta. Revisa el valor y vuelve a intentar.',
            ];
        }

        $this->redirect('reto?slug=' . $slug);
    }

    private function findNextChallenge(int $currentNumber): ?array
    {
        foreach (Challenge::all() as $challenge) {
            if ((int) $challenge['numero'] === $currentNumber + 1) {
                return $challenge;
            }
        }

        return null;
    }

    private function isValidFlag(array $reto, string $submittedFlag): bool
    {
        if ($submittedFlag === '') {
            return false;
        }

        $validator = $this->validatorFor($reto);

        if (isset($validator['flag'])) {
            $flag = (string) $validator['flag'];

            return hash_equals($flag, $submittedFlag)
                || hash_equals('FLAG{' . $flag . '}', $submittedFlag)
                || hash_equals('flag{' . $flag . '}', $submittedFlag);
        }

        if (isset($validator['flags']) && is_array($validator['flags'])) {
            foreach ($validator['flags'] as $flag) {
                if (hash_equals((string) $flag, $submittedFlag)) {
                    return true;
                }
            }
        }

        if (isset($validator['pattern'])) {
            return preg_match((string) $validator['pattern'], $submittedFlag) === 1;
        }

        if (!isset($validator['flag_format'])) {
            return false;
        }

        $format = (string) $validator['flag_format'];
        $pattern = '/^' . str_replace('\*', '.+', preg_quote($format, '/')) . '$/i';

        return preg_match($pattern, $submittedFlag) === 1;
    }

    private function validatorFor(array $reto): array
    {
        $validatorFile = dirname(__DIR__, 2) . '/challenges/' . $reto['slug'] . '/validator.php';
        $validator = is_file($validatorFile) ? require $validatorFile : [];

        return is_array($validator) ? $validator : [];
    }

    private function isValidAnswer(array $validator, string $answer): bool
    {
        if ($answer === '') {
            return false;
        }

        $validAnswers = [];
        $normalizedAnswer = $this->normalizeAnswer($answer);

        if (isset($validator['answer_contains'])) {
            $needle = $this->normalizeAnswer((string) $validator['answer_contains']);

            if ($needle !== '' && str_contains($normalizedAnswer, $needle)) {
                return true;
            }
        }

        if (isset($validator['answer_contains_all']) && is_array($validator['answer_contains_all'])) {
            foreach ($validator['answer_contains_all'] as $needle) {
                $normalizedNeedle = $this->normalizeAnswer((string) $needle);

                if ($normalizedNeedle === '' || !str_contains($normalizedAnswer, $normalizedNeedle)) {
                    return false;
                }
            }

            return true;
        }

        if (isset($validator['answer'])) {
            $validAnswers[] = (string) $validator['answer'];
        }

        if (isset($validator['answers']) && is_array($validator['answers'])) {
            foreach ($validator['answers'] as $validAnswer) {
                $validAnswers[] = (string) $validAnswer;
            }
        }

        foreach ($validAnswers as $validAnswer) {
            if ($normalizedAnswer === $this->normalizeAnswer($validAnswer)) {
                return true;
            }
        }

        return false;
    }

    private function normalizeAnswer(string $answer): string
    {
        return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', $answer) ?? '');
    }

    private function isCompleted(string $slug): bool
    {
        return isset($this->progress()['completed'][$slug]);
    }

    private function markCompleted(array $reto): void
    {
        $key = $this->progressKey();
        $_SESSION['challenge_progress'][$key]['completed'][$reto['slug']] = [
            'points' => (int) $reto['puntaje'],
            'completed_at' => date('c'),
        ];
        $_SESSION['challenge_progress'][$key]['points'] = $this->currentPoints() + (int) $reto['puntaje'];
    }

    private function currentPoints(): int
    {
        return (int) ($this->progress()['points'] ?? 0);
    }

    private function progress(): array
    {
        $key = $this->progressKey();
        $progress = $_SESSION['challenge_progress'][$key] ?? null;

        return is_array($progress) ? $progress : ['points' => 0, 'completed' => []];
    }

    private function progressKey(): string
    {
        return (string) ($_SESSION['user']['username'] ?? 'guest');
    }
}
