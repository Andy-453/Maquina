<section class="hero">
    <div class="hero-copy">
        <span class="eyebrow">Laboratorio local</span>
        <h1>Base web para un CTF progresivo en una sola maquina</h1>
        <p>
            Esta estructura separa el portal principal, la logica del sistema, los retos y los servicios vulnerables
            para que el proyecto sea mantenible incluso cuando crezca a 12 escenarios o mas.
        </p>
        <div class="hero-actions">
            <a class="button" href="<?= htmlspecialchars(route('retos'), ENT_QUOTES, 'UTF-8'); ?>">Ver retos</a>
            <a class="button button-secondary" href="#mapa">Ver arquitectura</a>
        </div>
    </div>
    <aside class="hero-card">
        <h2>Resumen</h2>
        <ul class="stat-list">
            <li><strong><?= htmlspecialchars((string) $stats['total'], ENT_QUOTES, 'UTF-8'); ?></strong> retos planeados</li>
            <li><strong><?= htmlspecialchars((string) $stats['categorias'], ENT_QUOTES, 'UTF-8'); ?></strong> categorias principales</li>
            <li><strong><?= htmlspecialchars((string) $stats['puntaje'], ENT_QUOTES, 'UTF-8'); ?></strong> puntos totales</li>
        </ul>
    </aside>
</section>


<section class="panel">
    <span class="eyebrow">Retos destacados</span>
    <h2>Primeros modulos preparados</h2>
    <div class="challenge-grid">
        <?php foreach ($retos as $reto): ?>
            <article class="challenge-card">
                <div class="challenge-top">
                    <span>Reto <?= htmlspecialchars((string) $reto['numero'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span><?= htmlspecialchars($reto['dificultad'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <h3><?= htmlspecialchars($reto['titulo'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p><?= htmlspecialchars($reto['objetivo'], ENT_QUOTES, 'UTF-8'); ?></p>
                <a href="<?= htmlspecialchars(route('reto?slug=' . $reto['slug']), ENT_QUOTES, 'UTF-8'); ?>">Abrir reto</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
