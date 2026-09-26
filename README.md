# DJ Fabrizia — Backoffice (DJ_BACKOFFICE)

Headless WordPress CMS for the DJ Fabrizia website. Runs inside a Docker container and serves as the content management layer consumed by the API endpoint (DJ_ENDPOINT) and the Vue frontend (DJ_HEAD).

---

## Tech Stack

| Technology | Details |
|---|---|
| PHP | 8.4 (FrankenPHP Alpine) |
| WordPress | 6.9.4 |
| Database | MariaDB via DJ_DB container |

---

## Installed Plugins

| Plugin | Purpose |
|---|---|
| Advanced Custom Fields Pro | Custom field definitions for all post types |
| Contact Form 7 | Contact / booking form handling |
| Contact Form CFDB7 | Stores form submissions to the database |
| Disable Gutenberg | Reverts to classic editor |
| Post Types Order | Manual ordering of custom post types |
| WP Dark Mode | Dark mode UI for the admin panel |
| WP Sweep | Database cleanup utility |
| YouTube Channel | YouTube feed integration |

Active theme: **headless** (minimal theme — no frontend, exposes content via WordPress REST API / ACF).

---

## Running Dev Mode

The container starts alongside the rest of the stack from the `djfabrizia-endpoint` project directory.

```bash
# Start all services
docker compose up -d

# Start backoffice container only
docker compose up -d djbackoffice

# Restart backoffice container only
docker compose restart djbackoffice

# View logs
docker logs DJ_BACKOFFICE -f
```

**Port:** `5050` → container `8080`  
**Admin panel:** http://localhost:5050/wp-admin  
**REST API:** http://localhost:5050/wp-json/wp/v2/

---

## Running Commands Inside the Container

```bash
docker exec DJ_BACKOFFICE sh -c "<command>"
```

Example — flush WordPress rewrite rules:

```bash
docker exec DJ_BACKOFFICE sh -c "wp --allow-root rewrite flush"
```

---

## Database

The backoffice shares the MariaDB instance managed by the DJ_DB container.

| Setting | Value |
|---|---|
| Host | `DJ_DB` |
| Database | `djfabriz_headless` |
| Port | `3306` (internal) / `4306` (host) |
| Table prefix | `dj_` |

The database container must be healthy before the backoffice container starts (`depends_on: djdb`).

---

## Environment

The container mounts this repository root into `/var/www` and uses `php -S 0.0.0.0:8080` to serve from that directory. Configuration lives in `wp-config.php`.
