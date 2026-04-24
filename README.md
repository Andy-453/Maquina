# CTF REACH

Base de proyecto para un laboratorio Capture The Flag en `PHP` puro sobre `XAMPP`.

## Inicio rapido

1. Coloca la carpeta dentro de `htdocs`.
2. Abre `http://localhost/maquina`.
3. Importa `database/schema.sql` y luego `database/seed.sql` en `phpMyAdmin` si quieres persistencia.

## Estructura principal

- `index.php`: entrada de la aplicacion.
- `app/`: logica principal.
- `public/assets/`: estilos y scripts.
- `challenges/`: retos desacoplados.
- `lab/`: entorno vulnerable local.
- `docs/`: decisiones de arquitectura.

## Nota

`contexto.txt` se conserva como referencia funcional del proyecto.
