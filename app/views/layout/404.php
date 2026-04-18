<section class="panel panel-centered">
    <span class="eyebrow">404</span>
    <h1>Ruta no encontrada</h1>
    <p>No existe contenido para <code><?= htmlspecialchars($path ?? '/', ENT_QUOTES, 'UTF-8'); ?></code>.</p>
    <a class="button" href="<?= htmlspecialchars(route(), ENT_QUOTES, 'UTF-8'); ?>">Volver al inicio</a>
</section>
