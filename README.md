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

## Deployment — GitHub Actions → FTP (Host4India)

`.github/workflows/deploy.yml` is the deploy mechanism in use: on every push to `main`, GitHub's
runner builds the app (`composer install`, `npm run build`) and uploads only the built,
production-ready files to `public_html/rajwada.mars.host4india.in/` over FTP. Nothing executes on
the shared-hosting server itself, so no SSH or `exec()` access is required there — just an FTP
account.

**One-time setup**

In the GitHub repo → **Settings → Secrets and variables → Actions**, add:

| Secret          | Value                                            |
|------------------|---------------------------------------------------|
| `FTP_SERVER`      | Host4India FTP hostname (e.g. `ftp.host4india.in` or the server IP) |
| `FTP_USERNAME`    | FTP account username                              |
| `FTP_PASSWORD`    | FTP account password                              |

Then confirm, via cPanel → **Domains**, that `rajwada.mars.host4india.in`'s document root points
at `public_html/rajwada.mars.host4india.in/public` (Laravel's `public/` folder) — not the app root
— so the rest of the framework (`app/`, `.env`, etc.) isn't web-accessible.

**What happens on push to `main`**

1. Checkout → PHP 8.2 + Composer (`--no-dev --optimize-autoloader`) → Node 20 + `npm ci && npm run build`
2. The result is staged into a clean folder, excluding `.git`, `node_modules`, `tests`, `.env`,
   and anything that's server-owned state: `storage/app/public` (admin-uploaded images),
   `storage/framework/*`, `storage/logs`, `public/storage` (the symlink), `database/database.sqlite`
3. That staged folder is FTP-uploaded to `public_html/rajwada.mars.host4india.in/`

**What it deliberately does *not* do:** run `php artisan migrate`, `config:cache`, `route:cache`,
or `view:cache` on the server — the GitHub runner never sees production's real `.env`, so it can't
safely generate those. After a deploy that changes the database schema or config, run those
commands manually via cPanel's **Terminal** app (or SSH, if enabled on the plan).

**If your FTP account is already chrooted into `public_html/`** (some hosts do this), edit the
`server-dir` line in `deploy.yml` from `./public_html/rajwada.mars.host4india.in/` to
`./rajwada.mars.host4india.in/`.

`public/deploy.php` (a webhook-triggered self-deploy script) still exists in the repo but is
**not** the active deploy path — GitHub Actions above is. It's left in place in case a future host
offers SSH/exec access and a webhook-based deploy becomes preferable; the corresponding GitHub
webhook was never actually configured, so it does nothing unless someone wires it up.

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
