<section class="panel">
    <span class="eyebrow">RETOS</span>
    <h1>Desafíos Cibernéticos</h1>
    <p>
        EN ESTA CTF VAS A ENCONTRAR RETOS DE DIFERENTES CATEGORIAS Y DIFICULTADES, CADA RETO TE OFRECERA UNA
        EXPERIENCIA UNICA PARA DESARROLLAR TUS HABILIDADES EN CIBERSEGURIDAD.
        EXPLORA LOS RETOS DISPONIBLES Y ENFRENTA LOS DESAFIOS QUE TE ESPERAN.
    </p>
</section>

<section class="challenge-grid">
    <?php foreach ($retos as $reto): ?>
        <article class="challenge-card">
            <div class="challenge-top">
                <span><?= htmlspecialchars($reto['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span class="challenge-status <?= $reto['isCompleted'] ? 'completed' : 'pending'; ?>">
                    <?= $reto['isCompleted'] ? 'Completado' : 'Pendiente'; ?>
                </span>
                <span><?= htmlspecialchars($reto['puntaje'] . ' pts', ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <h2>Reto <?= htmlspecialchars((string) $reto['numero'], ENT_QUOTES, 'UTF-8'); ?>: <?= htmlspecialchars($reto['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?= htmlspecialchars($reto['objetivo'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Herramientas:</strong> <?= htmlspecialchars(implode(', ', $reto['herramientas']), ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="<?= htmlspecialchars(route('reto?slug=' . $reto['slug']), ENT_QUOTES, 'UTF-8'); ?>">Ver detalle</a>
        </article>
    <?php endforeach; ?>
</section>
