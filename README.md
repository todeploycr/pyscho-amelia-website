# Psicóloga Amelia Reyes

Sitio estático hecho con [Astro](https://astro.build) + Tailwind CSS. Publicado en https://psicologaameliareyes.com

## Desarrollo

```sh
npm ci          # instalar dependencias
npm run dev     # servidor local en http://localhost:4321
npm run build   # compilar a dist/
npm run preview # ver el build localmente
```

Los datos de contacto (teléfono, correo, WhatsApp, Instagram) están centralizados en `src/config/site.ts`.

## Despliegue

**Automático:** cada merge a `main` compila el sitio y lo publica en Hostinger
(workflow `.github/workflows/deploy.yml`). También se puede lanzar a mano desde
*Actions → Deploy a Hostinger → Run workflow*.

El workflow:
1. Compila el sitio y verifica que el build sea válido.
2. Guarda un respaldo de la versión actual en `~/backups/` del servidor (conserva los últimos 5).
3. Sincroniza `dist/` con `public_html` usando `rsync`.
4. Comprueba que las páginas principales respondan 200.

Archivos que **solo existen en el servidor** y el despliegue nunca toca:
`send-email.php`, `PHPMailer/`, `robots.txt`, `n8n/`, `n8na/`, `.htaccess`.

Requiere el secret `HOSTINGER_SSH_KEY` en *Settings → Secrets and variables → Actions*,
con una llave autorizada en hPanel → Acceso SSH.

**Restaurar un respaldo:**

```sh
ssh -p 65002 u304762327@46.202.183.24
ls ~/backups/                                   # elegir el respaldo
cd ~/domains/psicologaameliareyes.com && tar -xzf ~/backups/<archivo>.tar.gz
```
