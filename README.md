# Rajwada Events — Website & Admin Panel

Laravel-powered website for **Rajwada Events** (luxury wedding & event planning, Jaipur), with a
TailAdmin-based admin panel for managing every section of the site — no code changes required to
update content.

Built on top of the [LaravelDaily TailAdmin Starter Kit](https://github.com/LaravelDaily/TailAdmin-Laravel-Starter-Kit)
(Laravel 12, Tailwind CSS v4, Alpine.js, Blade-only — no React/Vue/Livewire), retheme with the
brand's own maroon & gold palette, plus custom models, controllers and admin screens for the
site's content.

## Stack

- Laravel 12 (PHP 8.2+)
- MySQL
- Tailwind CSS v4 + Alpine.js (admin panel), Vite for asset building
- CKEditor 5 (self-hosted/GPL, via CDN) for rich-text content fields
- Vanilla HTML/CSS/jQuery + Slick Carousel for the public-facing site markup

## What's admin-managed

Everything under **Site Content** in the admin sidebar maps 1:1 to a section of the homepage:

| Admin section       | Public page section                          |
|----------------------|-----------------------------------------------|
| Homepage Hero         | Hero banner, background strip images, ticker |
| About Us               | About section (rich text via CKEditor)      |
| Services                | "Our Services" cards                        |
| Gallery                  | Gallery grid                               |
| Blogs & Stories          | "Blogs & Stories" cards                    |
| Testimonials             | Testimonial slider                         |
| Contact Messages         | Inbox for the public contact form           |
| Site Settings             | Logo, phone, WhatsApp, email, address, footer text |

Changes made in the admin panel are reflected on the live site immediately — no rebuild or deploy
needed for content edits (images and text). A deploy is only needed when the *code* changes.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure the database in `.env` (MySQL by default — create an empty database first), then:

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

`db:seed` creates the initial admin user and seeds all content tables from the original static
design so the site looks right on first run. Set the admin email/password in
`database/seeders/DatabaseSeeder.php` before seeding a fresh environment.

- Public site: `http://127.0.0.1:8000/`
- Admin panel: `http://127.0.0.1:8000/login`

While actively editing frontend assets (`resources/css`, `resources/js`), run `npm run dev`
instead of `npm run build` for hot reload.

## Project layout notes

- `resources/views/frontend/home.blade.php` — the entire public homepage, pulling data from the
  models below. This replaced the original static `html/index.html` (kept in `html/` as a
  reference — not used by the app).
- `app/Models/{HeroContent,HeroStripImage,TickerItem,AboutContent,Service,GalleryImage,BlogPost,
  Testimonial,ContactMessage,Setting}.php` — one model per content type above.
- `app/Http/Controllers/*Controller.php` — matching CRUD controllers; images are uploaded to
  `storage/app/public` via the `HandlesImageUploads` trait and served through the `public/storage`
  symlink.
- `resources/views/layouts/{app,sidebar,app-header}.blade.php` — the admin shell (retthemed with
  the brand's maroon/gold palette in `resources/css/app.css`).
- `resources/views/components/forms/*.blade.php` — shared form field components (`input`,
  `textarea`, `file`, `checkbox`, `richtext`) used across all admin CRUD forms.

## Deployment — GitHub webhook auto-deploy

`public/deploy.php` is a self-contained webhook endpoint: when GitHub delivers a `push` event to
`main`, it pulls the latest code and rebuilds the app on the server. No CI runner needed — it runs
directly on the host via a webhook.

**Server prerequisites**

- `git`, `composer`, `node`/`npm` available in the PATH of the user PHP runs as
- PHP's `exec()`/`shell_exec()` not disabled (`disable_functions` in `php.ini`) — some cheap shared
  hosts block this; check before relying on this script
- The deploy user needs write access to the whole project and push access to the git remote

**Setup**

1. On the server, set `DEPLOY_WEBHOOK_SECRET` in `.env` to a long random value (never commit this),
   and `DEPLOY_BRANCH` if you deploy from a branch other than `main`.
2. On GitHub: repo → **Settings → Webhooks → Add webhook**
   - Payload URL: `https://your-domain.com/deploy.php`
   - Content type: `application/json`
   - Secret: the same value as `DEPLOY_WEBHOOK_SECRET`
   - Events: **Just the push event**
3. Push to `main`. GitHub calls `deploy.php`, which verifies the `X-Hub-Signature-256` HMAC against
   the secret, checks the ref is `refs/heads/{DEPLOY_BRANCH}`, then runs:

   ```
   git fetch --depth=1 origin main
   git reset --hard origin/main
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm ci
   npm run build
   ```

Every run is logged to `storage/logs/deploy.log`. A lock file
(`storage/framework/deploy.lock`) prevents two deploys from overlapping if GitHub redelivers the
webhook. Requests with a missing/invalid signature return `403` and are logged but never touch the
working tree; a push to any branch other than `DEPLOY_BRANCH` is acknowledged (`200`) and ignored.

**If the server can't run Node** (no `npm`/`node` in PATH — common on shared hosting): drop the
`npm ci` / `npm run build` steps from `deploy.php` and instead commit the built `public/build/`
output to the repo, rebuilding it locally before each push.

> The repo's current git remote has a personal access token embedded directly in the URL
> (`https://user:TOKEN@github.com/...`), which is stored in plaintext in `.git/config`. Worth
> rotating that token and switching to SSH or a credential manager when convenient.

## Admin theme

The admin panel is retheme'd (not the stock TailAdmin blue) to match the site's brand:

- Brand color scale (`--color-brand-*` in `resources/css/app.css`) uses the same maroon values as
  the public site's `html/css/style.css`, plus a `--color-gold-*` accent scale
- Sidebar is a fixed dark maroon gradient with gold active-state accents (independent of the
  light/dark mode toggle, which only affects the content area)
- Page titles and the dashboard headline use Playfair Display (matches the site's display font);
  everything else stays on Outfit for readability
- Logo, favicon, and auth-page branding all use the real Rajwada Events crest
