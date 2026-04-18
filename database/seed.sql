USE maquina_ctf;

INSERT INTO challenges (slug, title, category, difficulty, points) VALUES
('reto01-osint', 'OSINT Inicial', 'Reconocimiento', 'Facil', 50),
('reto02-nmap', 'Escaneo de Servicios', 'Reconocimiento', 'Facil', 75),
('reto03-sqli', 'Inyeccion SQL', 'Web', 'Media', 100),
('reto04-xss', 'XSS Reflejado y Almacenado', 'Web', 'Media', 100),
('reto05-upload', 'Subida de Archivos', 'Web', 'Media', 125),
('reto06-auth', 'Autenticacion Debil', 'Web', 'Media', 125),
('reto07-stego', 'Esteganografia', 'Analisis', 'Media', 150),
('reto08-cve', 'Analisis de CVE', 'Analisis', 'Alta', 175),
('reto09-metasploit', 'Automatizacion con Metasploit', 'Explotacion', 'Alta', 175),
('reto10-local', 'Escalada Local Simulada', 'Post Explotacion', 'Alta', 200),
('reto11-forensics', 'Forense Basico', 'Analisis', 'Alta', 200),
('reto12-final', 'Reto Final Encadenado', 'Final', 'Experto', 300);
