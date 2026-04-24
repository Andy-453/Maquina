<section class="panel">
    <span class="eyebrow"><?= htmlspecialchars($reto['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
    <h1>Reto <?= htmlspecialchars((string) $reto['numero'], ENT_QUOTES, 'UTF-8'); ?>: <?= htmlspecialchars($reto['titulo'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><?= htmlspecialchars($reto['objetivo'], ENT_QUOTES, 'UTF-8'); ?></p>
    <div class="detail-grid">
        <article>
            <h2>Dificultad</h2>
            <p><?= htmlspecialchars($reto['dificultad'], ENT_QUOTES, 'UTF-8'); ?></p>
        </article>
        <article>
            <h2>Puntaje</h2>
            <p><?= htmlspecialchars((string) $reto['puntaje'], ENT_QUOTES, 'UTF-8'); ?> puntos</p>
        </article>
        <article>
            <h2>Estado</h2>
            <p><?= $isCompleted ? 'Completado' : htmlspecialchars($reto['estado'], ENT_QUOTES, 'UTF-8'); ?></p>
        </article>
        <article>
            <h2>Tus puntos</h2>
            <p><?= htmlspecialchars((string) $totalPoints, ENT_QUOTES, 'UTF-8'); ?> puntos</p>
        </article>
    </div>
</section>

<?php if ($reto['slug'] === 'reto01-osint'): ?>
    <!-- TODO: eliminar este comentario antes de producción -->
    <!-- FLAG{ReCo#_Pa$!ivO} -->
<?php endif; ?>

<section class="panel">
    <h2>Herramientas y enfoque</h2>
    <p><?= htmlspecialchars(implode(', ', $reto['herramientas']), ENT_QUOTES, 'UTF-8'); ?></p>
</section>

<section class="panel flag-panel">
    <?php if (!empty($flagResult)): ?>
        <div class="flag-popup flag-popup-<?= htmlspecialchars($flagResult['type'], ENT_QUOTES, 'UTF-8'); ?>" role="alert">
            <strong><?= $flagResult['type'] === 'success' ? 'Flag correcta' : 'Flag incorrecta'; ?></strong>
            <span><?= htmlspecialchars($flagResult['message'], ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
    <?php endif; ?>

    <div>
        <h2>Verificar flag</h2>
        <p>Ingresa la flag encontrada para validar tu progreso en este reto.</p>
    </div>

    <?php if (empty($flagResult) && $isCompleted): ?>
        <p class="form-alert form-alert-success" role="status">Este reto ya esta completado.</p>
    <?php endif; ?>

    <form class="flag-form" action="<?= htmlspecialchars(route('reto/verificar'), ENT_QUOTES, 'UTF-8'); ?>" method="post">
        <input type="hidden" name="slug" value="<?= htmlspecialchars($reto['slug'], ENT_QUOTES, 'UTF-8'); ?>">
        <label for="flag">Flag</label>
        <div class="flag-actions">
            <input id="flag" name="flag" type="text" placeholder="flag{...}" autocomplete="off" required>
            <button class="button" type="submit">Verificar flag</button>
        </div>
    </form>

    <div class="challenge-actions">
        <a class="button button-secondary" href="<?= htmlspecialchars(route('retos'), ENT_QUOTES, 'UTF-8'); ?>">Volver al listado</a>
        <?php if ($nextReto !== null): ?>
            <a class="button" href="<?= htmlspecialchars(route('reto?slug=' . $nextReto['slug']), ENT_QUOTES, 'UTF-8'); ?>">Siguiente reto</a>
        <?php endif; ?>
    </div>
</section>
