<section class="auth-panel">
    <div class="auth-copy">
        <span class="eyebrow">Registro</span>
        <h1>Crear cuenta</h1>
        <p>Crea un usuario para guardar tu sesion dentro del laboratorio.</p>
    </div>

    <form class="auth-form" method="post" action="<?= htmlspecialchars(route('registro'), ENT_QUOTES, 'UTF-8'); ?>">
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
            <input type="password" name="password" autocomplete="new-password" minlength="4" required>
        </label>

        <button class="button" type="submit">Crear cuenta</button>
        <p class="form-note">Ya tienes cuenta? <a href="<?= htmlspecialchars(route('login'), ENT_QUOTES, 'UTF-8'); ?>">Inicia sesion</a></p>
    </form>
</section>
