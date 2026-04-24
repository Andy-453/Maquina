<section class="hero">
    <div class="hero-copy">
        <span class="eyebrow">REACH</span>
        <h1>CTF PROGRESIVO REACH</h1>
        <p>
            REACH es una plataforma de CTF disenada para ofrecer una experiencia de aprendizaje progresiva.
            Con retos cuidadosamente estructurados, los participantes pueden desarrollar sus habilidades
            de ciberseguridad a su propio ritmo, enfrentandose a desafios que van desde lo basico
            hasta lo avanzado.
        </p>
         
        <div class="hero-actions">
            <a class="button" href="<?= htmlspecialchars(route('retos'), ENT_QUOTES, 'UTF-8'); ?>">Ver retos</a>
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
    <h2>Primeros modulos</h2>
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
