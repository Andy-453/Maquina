USE maquina_ctf;

INSERT INTO challenges (slug, title, category, difficulty, points) VALUES
('reto01-osint', 'Reconocimiento pasivo', 'Reconocimiento', 'Facil', 50),
('reto02-nmap', 'Descubrimiento de red', 'Reconocimiento', 'Facil', 75),
('reto03-puertos', 'Escaneo de puertos', 'Enumeracion', 'Media', 100),
('reto04-servicios', 'Enumeracion de servicios', 'Enumeracion', 'Media', 125),
('reto05-credenciales', 'Acceso por credenciales debiles', 'Explotacion inicial', 'Media', 125),
('reto06-sqli-login', 'SQL Injection (login bypass)', 'Explotacion web', 'Media', 150),
('reto07-sqli-datos', 'SQL Injection (extraccion de datos)', 'Explotacion web', 'Alta', 150),
('reto08-xss', 'XSS (Cross Site Scripting)', 'Explotacion web', 'Alta', 175),
('reto09-stego', 'Esteganografia', 'Analisis', 'Alta', 175),
('reto10-cve', 'Analisis de vulnerabilidades (CVE)', 'Analisis', 'Alta', 200),
('reto11-metasploit', 'Explotacion con Metasploit', 'Explotacion', 'Alta', 225),
('reto12-privesc', 'Escalada de privilegios', 'Post explotacion', 'Experto', 300);
