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
            <p><?= htmlspecialchars($reto['estado'], ENT_QUOTES, 'UTF-8'); ?></p>
        </article>
    </div>
</section>

<section class="panel">
    <h2>Herramientas y enfoque</h2>
    <p><?= htmlspecialchars(implode(', ', $reto['herramientas']), ENT_QUOTES, 'UTF-8'); ?></p>
    <a class="button button-secondary" href="<?= htmlspecialchars(route('retos'), ENT_QUOTES, 'UTF-8'); ?>">Volver al listado</a>
</section>
