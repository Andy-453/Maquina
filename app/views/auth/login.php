<section class="auth-panel">
    <div class="auth-copy">
        <span class="eyebrow">Acceso</span>
        <h1>Iniciar sesion</h1>
        <p>Entra con tu cuenta para continuar con los retos de CTF REACH.</p>
    </div>

    <form class="auth-form" method="post" action="<?= htmlspecialchars(route('login'), ENT_QUOTES, 'UTF-8'); ?>">
        <?php if (!empty($error)): ?>
            <p class="form-alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <label>
            Usuario
            <input
                type="text"
                name="username"
                value="<?= htmlspecialchars($username ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                autocomplete="username"
                required
            >
        </label>

        <label>
            Contrasena
            <input type="password" name="password" autocomplete="current-password" required>
        </label>

        <button class="button" type="submit">Entrar</button>
        <p class="form-note">No tienes cuenta? <a href="<?= htmlspecialchars(route('registro'), ENT_QUOTES, 'UTF-8'); ?>">Registrate</a></p>
    </form>
</section>
