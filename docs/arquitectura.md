# Arquitectura base

## Objetivo

Organizar el proyecto como un portal web en PHP puro que orquesta un laboratorio CTF local con 12 retos.

## Capas

- `index.php`: punto de entrada y enrutado simple.
- `app/`: configuracion, controladores, modelos y vistas.
- `public/`: assets web accesibles desde el navegador.
- `challenges/`: modulos autocontenidos para cada reto.
- `lab/`: servicios y aplicaciones vulnerables del laboratorio.
- `database/`: esquema y semillas.
- `storage/`: sesiones, logs, cache y banderas.

## Principio clave

El portal principal debe ser estable y mantenible. Las vulnerabilidades intencionales viven en `challenges/` y `lab/`, no en la base del sistema.
