# Memoria Tecnica Completa del CTF REACH

## 1) Resumen del proyecto

CTF REACH es un laboratorio de ciberseguridad tipo Capture The Flag construido en PHP puro sobre XAMPP, alojado en `htdocs` y diseñado para ejecutarse en entorno local. El objetivo principal del proyecto es ofrecer 12 retos progresivos que cubren reconocimiento, enumeracion, explotacion web, analisis y post-explotacion, manteniendo aisladas las vulnerabilidades intencionales del portal principal.

Referencias base:
- `README.md`
- `contexto.txt`
- `docs/arquitectura.md`

## 2) Alcance funcional implementado

El sistema implementado permite:
- Registro e inicio de sesion de usuarios.
- Navegacion por retos con detalle por desafio.
- Verificacion de respuestas intermedias (retos guiados de escaneo/enumeracion).
- Verificacion de flags finales por reto.
- Sistema de puntaje acumulado por usuario en sesion.
- Persistencia simple de usuarios en `storage/users.json`.
- Catalogo de 12 retos con metadata (categoria, dificultad, objetivo, herramientas, puntaje).

## 3) Decision de arquitectura y separacion de responsabilidades

Se aplico una separacion por capas para evitar mezclar el portal estable con contenido vulnerable:

- `index.php`: punto de entrada y declaracion de rutas.
- `app/bootstrap.php`: inicializacion global (constantes, autoload, sesion, configuracion en contenedor).
- `app/core/`: infraestructura minima tipo MVC (`Router`, `Controller`, `View`, `Container`).
- `app/controllers/`: logica de flujo de autenticacion y retos.
- `app/models/`: acceso a datos simplificado (usuarios y retos).
- `app/views/`: interfaz web del portal.
- `app/config/`: parametros de aplicacion, BD y lista de retos.
- `challenges/`: retos desacoplados con `description.md` + `validator.php`.
- `lab/`: espacio reservado para servicios/aplicaciones vulnerables dentro de la misma maquina.
- `database/`: scripts SQL de esquema y semillas.
- `storage/`: datos de usuarios y estado local.

Esta separacion sigue el principio declarado en `docs/arquitectura.md`: las vulnerabilidades intencionales deben vivir en `challenges/` y `lab/`, no en la base del portal.

## 4) Flujo de arranque y ejecucion

1. El servidor recibe la peticion en `index.php`.
2. `app/bootstrap.php`:
   - Define `BASE_PATH`, `APP_PATH`, `PUBLIC_PATH`, `STORAGE_PATH`.
   - Registra autoloader para namespace `App\`.
   - Carga configuraciones desde `app/config/app.php` y `app/config/retos.php`.
   - Configura zona horaria (`America/Bogota`).
   - Inicia sesion con nombre `maquina_ctf`.
   - Publica configuraciones en `Container`.
3. `Router` resuelve metodo y path, ajusta `base_url` (`/maquina`) y despacha al controlador correspondiente.
4. Si no existe ruta: respuesta 404 con vista dedicada.

## 5) Enrutamiento implementado

Rutas definidas:
- `GET /` -> `HomeController::index`
- `GET /login` -> `AuthController::login`
- `POST /login` -> `AuthController::authenticate`
- `GET /registro` -> `AuthController::register`
- `POST /registro` -> `AuthController::store`
- `POST /logout` -> `AuthController::logout`
- `GET /retos` -> `ChallengeController::index`
- `GET /reto` -> `ChallengeController::show` (usa query `slug`)
- `POST /reto/respuesta` -> `ChallengeController::verifyAnswer`
- `POST /reto/verificar` -> `ChallengeController::verify`

## 6) Sistema de autenticacion y usuarios

Implementado en `AuthController` + `User`:

- Registro:
  - Normaliza username a minuscula.
  - Exige password minima de 4 caracteres.
  - Evita duplicados.
  - Guarda hash con `password_hash(PASSWORD_DEFAULT)`.
- Login:
  - Busca usuario en JSON.
  - Verifica con `password_verify`.
- Seguridad de sesion:
  - `session_regenerate_id(true)` en login, registro y logout.
- Almacenamiento:
  - Archivo `storage/users.json` (persistencia liviana sin requerir BD activa).

Nota: aunque existe configuracion SQL (`app/config/database.php`) y esquema (`database/schema.sql`), la autenticacion actual en ejecucion usa JSON local, no MySQL.

## 7) Motor de retos y progreso

### 7.1 Catalogo de retos

`app/config/retos.php` define 12 retos con:
- `slug`, `numero`, `titulo`
- `categoria`, `dificultad`, `puntaje`
- `objetivo`, `herramientas`, `estado`

`Challenge::all()` devuelve ese arreglo; `Challenge::findBySlug()` resuelve un reto individual.

### 7.2 Control de acceso

`ChallengeController` aplica `requireAuth()` en listado, detalle y verificaciones.

### 7.3 Verificacion de respuestas intermedias

`verifyAnswer()` se usa en retos donde se valida un resultado previo (por ejemplo, comando/puertos). La validacion depende de reglas definidas en cada `validator.php`:
- `answer_contains`
- `answer_contains_all`
- `answer`
- `answers`

Si acierta, el sistema revela la flag asociada del reto en un modal.

### 7.4 Verificacion de flag final

`verify()` valida la flag enviada por el usuario contra reglas del validador:
- `flag` exacta
- `flags` multiples
- `pattern` regex
- `flag_format` (con soporte de comodin `*`)

Tambien existe tolerancia de formato con `flagCandidates()`:
- Acepta variantes con/sin envoltura `flag{...}`.
- Compara con `hash_equals`.

### 7.5 Puntaje y completado

- Se guarda por usuario en `$_SESSION['challenge_progress'][username]`.
- Estructura: puntos acumulados + mapa de retos completados con timestamp `completed_at`.
- Si un reto ya estaba completado, no vuelve a sumar puntos.

## 8) Interfaz y experiencia de uso

### 8.1 Layout global

`View::render()` siempre monta:
- `app/views/layout/header.php`
- vista solicitada
- `app/views/layout/footer.php`

El header incluye:
- Branding y tagline.
- Navegacion condicional por sesion.
- Indicador de puntaje en tiempo real.
- Versionado de CSS por `filemtime` para evitar cache stale.

### 8.2 Vistas de retos

- `retos/index.php`: tarjetas de retos con categoria, puntaje, objetivo y estado.
- `retos/show.php`: detalle completo, pistas por slug, formularios de verificacion y modales de resultado.

Se implementaron pistas especificas por reto y comentarios HTML internos con guias tecnicas (payloads/comandos) para apoyo pedagogico durante el laboratorio.

## 9) Diseno de datos (SQL disponible)

Aunque la ejecucion actual usa JSON para usuarios, el proyecto incluye base SQL para evolucion:

`database/schema.sql`:
- `users`
- `challenges`
- `submissions`

`database/seed.sql` precarga los 12 retos con metadatos base.

Esto deja preparada una migracion futura hacia persistencia completa en MySQL (usuarios, envios, scoring historico).

## 10) Definicion de retos y validadores

Cada reto vive en `challenges/<slug>/` con `description.md` y `validator.php`.

1. `reto01-osint`
- Tema: reconocimiento pasivo.
- Validacion: `flag = ReCo#_Pa$!ivO`.

2. `reto02-nmap`
- Tema: descubrimiento de red.
- Validacion intermedia: respuesta debe contener `nmap`.
- Flag: `PU#%to_3#Con%ado`.

3. `reto03-puertos`
- Tema: escaneo de puertos.
- Validacion intermedia: respuesta debe incluir `21`, `22`, `80`, `8080`.
- Flag: `3sC4n3r_d3_pu3rt0s`.

4. `reto04-servicios`
- Tema: enumeracion de servicios.
- Validacion intermedia: respuesta debe contener `8080`.
- Flag: `S3rv1c10s_3ncontr4d0s`.

5. `reto05-credenciales`
- Tema: acceso inicial por exposicion/configuracion debil.
- Validacion: `flag = $erVic1o_^ctiV*`.

6. `reto06-sqli-login`
- Tema: bypass de autenticacion por SQLi.
- Validacion: `flag = sql_B^Pa$$`.

7. `reto07-sqli-datos`
- Tema: extraccion de datos via SQLi.
- Validacion: `flag = sQl_St4cTi0n`.

8. `reto08-xss`
- Tema: ejecucion de scripts en navegador.
- Validacion: `flag = XsS_3xpl0it`.

9. `reto09-stego`
- Tema: esteganografia.
- Validacion: `flag_format = 3nc0d3r_3ncontr4d0`.

10. `reto10-cve`
- Tema: investigacion de vulnerabilidades conocidas.
- Validacion: `flag = Cv3_3xPlot^ble`.

11. `reto11-metasploit`
- Tema: explotacion asistida con framework.
- Validacion: `flag = M3T^sploit_Mas53r`.

12. `reto12-privesc`
- Tema: escalada de privilegios.
- Validacion: `flag = Pr1v1l3g3_Esc4l4t10n`.

## 11) Cronologia real de construccion (segun git)

Linea de tiempo obtenida del historial de commits:

- 2026-04-18: `Initial commit`
- 2026-04-18: `contexto`
- 2026-04-18: `Estructura base`
- 2026-04-24: `inicio, funcionalidad botones retos`
- 2026-04-24: `primera flag completada`
- 2026-04-25: `segundo reto`
- 2026-04-25: `retos 3,4 y 9`
- 2026-04-26: `modificacion reto 4, 9`
- 2026-05-02: `usuario creado`
- 2026-05-02: `Cambios de diseno`
- 2026-05-02: `cambios diseno y reto 6`
- 2026-05-03: `reto 7`
- 2026-05-03: `pistas retos 8 9`
- 2026-05-03: `coment`
- 2026-05-03: `cambios`
- 2026-05-06: `retos 10 y 11 check`
- 2026-05-06: `reto 12 listo`

Interpretacion: la construccion fue incremental, comenzando por base arquitectonica y navegacion, luego integrando retos por lotes, y finalmente cerrando con retos avanzados (10-12) y ajustes de experiencia.

## 12) Seguridad aplicada en el portal (no en los retos intencionalmente vulnerables)

En el portal base se observan buenas practicas:
- Escape de salida con `htmlspecialchars` en vistas.
- Hash de contrasenas con `password_hash`.
- Verificacion segura con `password_verify`.
- Regeneracion de ID de sesion en eventos criticos.
- Restriccion de acceso por autenticacion para rutas internas.

## 13) Limitaciones actuales identificadas

1. Persistencia dividida:
- Usuarios activos en JSON.
- Esquema SQL existente pero no integrado al flujo runtime.

2. Progreso solo en sesion:
- El scoring/completado no persiste en BD; al perder sesion, el estado se reinicia para ese navegador.

3. Trazabilidad:
- No hay tabla de intentos reales en uso, aunque existe `submissions` en SQL.

4. Entorno lab:
- `lab/` esta preparado conceptualmente, pero su contenido operativo depende de despliegues externos/manuales del entorno vulnerable.

## 14) Resultado final entregado por el proyecto

El CTF quedo funcional como portal web educativo local con:
- 12 retos definidos y navegables.
- Mecanismo de validacion flexible por reto.
- Flujo de usuario completo (registro, login, progreso, puntaje).
- Estructura mantenible para crecer (separacion portal/retos/lab).
- Base de datos preparada para evolucionar a persistencia completa.

## 15) Recomendaciones de siguiente fase

1. Integrar definitivamente MySQL para usuarios, progreso y envios.
2. Persistir progreso por usuario en tabla `submissions` o `challenge_progress`.
3. Versionar formalmente pistas y solucionarios (writeups internos).
4. Automatizar despliegue de `lab/` con scripts reproducibles.
5. Agregar panel administrador para activar/desactivar retos y ver ranking.

---

Documento generado con base en el estado real del repositorio en `C:\xampp\htdocs\maquina` y su historial git disponible hasta el commit actual (`74fab62`).
