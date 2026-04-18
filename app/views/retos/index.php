<section class="panel">
    <span class="eyebrow">Listado</span>
    <h1>Ruta de 12 retos</h1>
    <p>
        Esta vista centraliza el progreso del laboratorio y sirve como punto de entrada para cada escenario.
        Cada reto tiene un slug propio para facilitar expansion y mantenimiento.
    </p>
</section>

<section class="challenge-grid">
    <?php foreach ($retos as $reto): ?>
        <article class="challenge-card">
            <div class="challenge-top">
                <span><?= htmlspecialchars($reto['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span><?= htmlspecialchars($reto['puntaje'] . ' pts', ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <h2>Reto <?= htmlspecialchars((string) $reto['numero'], ENT_QUOTES, 'UTF-8'); ?>: <?= htmlspecialchars($reto['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?= htmlspecialchars($reto['objetivo'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Herramientas:</strong> <?= htmlspecialchars(implode(', ', $reto['herramientas']), ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="<?= htmlspecialchars(route('reto?slug=' . $reto['slug']), ENT_QUOTES, 'UTF-8'); ?>">Ver detalle</a>
        </article>
    <?php endforeach; ?>
</section>
