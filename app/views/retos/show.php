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
    <!-- eliminar este comentario antes de producción -->
    <!-- FLAG{ReCo#_Pa$!ivO} -->
<?php endif; ?>

<section class="panel">
    <h2>Herramientas y enfoque</h2>
    <p><?= htmlspecialchars(implode(', ', $reto['herramientas']), ENT_QUOTES, 'UTF-8'); ?></p>
</section>

<?php if ($reto['slug'] === 'reto02-nmap'): ?>
    <section class="panel split-module">
        <article class="split-card">
            <h2>Notas del escaneo</h2>
            <p>Realizar el escaneo ver que puertos estan abiertos y escribir el comando completo para el escaneo de los puertos
                por ejemplo: nmap "ip".
            </p>
        </article>
        <article class="split-card">
            <h2>Verificar respuesta</h2>
            <p>Cuando tengas el resultado, validalo aqui para revelar la flag del reto.</p>

            <form class="answer-form" action="<?= htmlspecialchars(route('reto/respuesta'), ENT_QUOTES, 'UTF-8'); ?>" method="post">
                <input type="hidden" name="slug" value="<?= htmlspecialchars($reto['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                <label class="field-label" for="scan-answer">Respuesta</label>
                <input id="scan-answer" name="answer" type="text" autocomplete="off" required>
                <button class="button" type="submit">Verificar respuesta</button>
            </form>
        </article>
    </section>

    <?php if (!empty($answerResult)): ?>
        <div class="answer-modal" role="dialog" aria-modal="true" aria-labelledby="answer-modal-title" onclick="if (event.target === this) this.remove();">
            <div class="answer-modal-card answer-modal-<?= htmlspecialchars($answerResult['type'], ENT_QUOTES, 'UTF-8'); ?>">
                <button class="answer-modal-close" type="button" aria-label="Cerrar mensaje" onclick="this.closest('.answer-modal').remove();">x</button>
                <strong id="answer-modal-title"><?= $answerResult['type'] === 'success' ? 'Respuesta correcta' : 'Respuesta incorrecta'; ?></strong>
                <p><?= htmlspecialchars($answerResult['message'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto03-puertos'): ?>
    <section class="panel split-module">
        <article class="split-card">
            <h2>Analisis de puertos</h2>
            <p>Realiza un escaneo de puertos sobre el objetivo y revisa cuales aparecen abiertos.</p>
        </article>
        <article class="split-card">
            <h2>Verificar respuesta</h2>
            <p>Escribe los puertos que estan abiertos</p>

            <form class="answer-form" action="<?= htmlspecialchars(route('reto/respuesta'), ENT_QUOTES, 'UTF-8'); ?>" method="post">
                <input type="hidden" name="slug" value="<?= htmlspecialchars($reto['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                <label class="field-label" for="port-answer">Respuesta</label>
                <input id="port-answer" name="answer" type="text" autocomplete="off" required>
                <button class="button" type="submit">Verificar respuesta</button>
            </form>
        </article>
    </section>

    <?php if (!empty($answerResult)): ?>
        <div class="answer-modal" role="dialog" aria-modal="true" aria-labelledby="answer-modal-title" onclick="if (event.target === this) this.remove();">
            <div class="answer-modal-card answer-modal-<?= htmlspecialchars($answerResult['type'], ENT_QUOTES, 'UTF-8'); ?>">
                <button class="answer-modal-close" type="button" aria-label="Cerrar mensaje" onclick="this.closest('.answer-modal').remove();">x</button>
                <strong id="answer-modal-title"><?= $answerResult['type'] === 'success' ? 'Respuesta correcta' : 'Respuesta incorrecta'; ?></strong>
                <p><?= htmlspecialchars($answerResult['message'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto04-servicios'): ?>
    <section class="panel split-module">
        <article class="split-card">
            <h2>Enumeracion de servicios</h2>
            <p>Analiza los servicios detectados y sus versiones. Usa la informacion del banner o el resultado de version detection para identificar la tecnologia expuesta.</p>
        </article>
        <article class="split-card">
            <h2>Verificar respuesta</h2>
            <p>Escribe el servicio o tecnologia principal que encontraste para revelar la flag del reto.</p>

            <form class="answer-form" action="<?= htmlspecialchars(route('reto/respuesta'), ENT_QUOTES, 'UTF-8'); ?>" method="post">
                <input type="hidden" name="slug" value="<?= htmlspecialchars($reto['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                <label class="field-label" for="service-answer">Respuesta</label>
                <input id="service-answer" name="answer" type="text" autocomplete="off" required>
                <button class="button" type="submit">Verificar respuesta</button>
            </form>
        </article>
    </section>

    <?php if (!empty($answerResult)): ?>
        <div class="answer-modal" role="dialog" aria-modal="true" aria-labelledby="answer-modal-title" onclick="if (event.target === this) this.remove();">
            <div class="answer-modal-card answer-modal-<?= htmlspecialchars($answerResult['type'], ENT_QUOTES, 'UTF-8'); ?>">
                <button class="answer-modal-close" type="button" aria-label="Cerrar mensaje" onclick="this.closest('.answer-modal').remove();">x</button>
                <strong id="answer-modal-title"><?= $answerResult['type'] === 'success' ? 'Respuesta correcta' : 'Respuesta incorrecta'; ?></strong>
                <p><?= htmlspecialchars($answerResult['message'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<section class="panel flag-panel">
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

<?php if (!empty($flagResult)): ?>
    <div class="answer-modal" role="dialog" aria-modal="true" aria-labelledby="flag-modal-title" onclick="if (event.target === this) this.remove();">
        <div class="answer-modal-card answer-modal-<?= htmlspecialchars($flagResult['type'], ENT_QUOTES, 'UTF-8'); ?>">
            <button class="answer-modal-close" type="button" aria-label="Cerrar mensaje" onclick="this.closest('.answer-modal').remove();">x</button>
            <strong id="flag-modal-title"><?= $flagResult['type'] === 'success' ? 'Flag correcta' : 'Flag incorrecta'; ?></strong>
            <p><?= htmlspecialchars($flagResult['message'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>
<?php endif; ?>
