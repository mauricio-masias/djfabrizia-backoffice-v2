# Deploying the back office (shared hosting)

Production is shared hosting with PHP, MySQL/MariaDB and cron, and no Docker, Redis or long-running processes. Everything the app does in the background goes through **one cron entry**.

## How background work runs

- Queued jobs (image variants and the Mixcloud, Spotify and YouTube syncs) are stored in the `jobs` table (`QUEUE_CONNECTION=database`).
- Cron runs `php artisan schedule:run` every minute. The schedule (`routes/console.php`) starts a short-lived worker, `queue:work --stop-when-empty --max-time=55`, which processes whatever is waiting and exits before the next minute. `withoutOverlapping` skips a minute while a previous worker is still busy.
- The daily syncs (03:00, 03:10, 03:20) are also triggered by the same cron entry.
- **Publishing to the website.**
  - When an editor saves, the back office asks the API (endpoint) to rebuild the affected pages right after the response is sent.
  - Anything that could not be sent (API busy or down), or that changed outside a web request (syncs, imports), waits in a pending list. The `endpoint-warm` task sends it every minute.
  - Content scheduled for a future date is picked up by the hourly `endpoint-warm-scheduled` task.
  - Every attempt is listed under System → Publish log.
- Failed jobs land in `failed_jobs`. List them with `php artisan queue:failed` and retry with `php artisan queue:retry all`.

## Cron entry (the only one needed)

In the hosting panel's cron section (or `crontab -e`), run every minute:

```cron
* * * * * cd /home/ACCOUNT/backoffice.example.com && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1
```

- Replace the path with the app root (the folder that contains `artisan`, not `public/`).
- Use the PHP 8.4 CLI binary. Hosts often have several; `which php` or the panel shows the right path, e.g. `/usr/local/bin/php84` or `/opt/cpanel/ea-php84/root/usr/bin/php`.
- To keep a log while you check the setup, send the output to `storage/logs/cron.log` instead of `/dev/null`.

**Check it works:** `php artisan schedule:list` shows `queue-drain` every minute. After uploading an image in the admin, the `jobs` table empties within a minute.

### Hostinger (hPanel)

hPanel → **Advanced → Cron Jobs** → **Custom**, schedule **every minute** (`* * * * *`), command:

```sh
cd /home/USER/domains/backoffice.example.com && /opt/alt/php84/usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

- `USER` is the account user (`u123456789`) and the folder is the one that holds `artisan`. Over SSH, `cd` into the app and run `pwd` to get the exact path.
- The PHP binary must be the 8.4 CLI. Check with `/opt/alt/php84/usr/bin/php -v`. If that path doesn't exist, `ls /opt/alt/` lists the versions installed. Plain `php` in cron can be a different version from the website's.
- For the first day, log to `storage/logs/cron.log` instead of `/dev/null` (`>> storage/logs/cron.log 2>&1`) to confirm it runs.

## First deployment

1. **Point the web root.** The back office subdomain must serve the `public/` folder, not the app root.
2. **Create the database.** Create the database (e.g. `djfabriz_cms`) and a user with full rights on it. Then create a second, read-only user for the endpoint with `SELECT` on the database and `INSERT` on the `bookings` table. `docker/scripts/bootstrap-db.sh` shows the exact grants.
3. **Install the code.** Either run `composer install --no-dev --optimize-autoloader` on the server (SSH; `packages/content` is inside this repo, so the path repository resolves), or build `vendor/` locally and upload it. **When uploading, build with `COMPOSER_MIRROR_PATH_REPOS=1 composer install --no-dev --optimize-autoloader`**: locally `vendor/djfabrizia/content` is a symlink into `packages/content`, SFTP and file managers drop symlinks, and the panel then fails with `Class Djfabrizia\Content\… not found`. Use `rsync -a --delete` for the upload.
4. **Build the assets** locally with `npm ci && npm run build`, then upload `public/build/`.
5. **Create `.env`** from `.env.example`:
   - `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://backoffice.example.com`, `LOG_LEVEL=warning`, `LOG_STACK=daily`, `SESSION_SECURE_COOKIE=true`
   - `APP_KEY` from `php artisan key:generate --show`. Keep it: the encrypted OAuth tokens depend on it.
   - `DB_*` for the database user from step 2.
   - `QUEUE_CONNECTION=database`, `CACHE_STORE=database`, `SESSION_DRIVER=database`
   - `ENDPOINT_URL`: the API's URL as seen from this server (e.g. `https://api.example.com`)
   - `ENDPOINT_WARM_TOKEN`: the same value as the endpoint's `CACHE_WARM_TOKEN`
   - `ENDPOINT_PREVIEW_TOKEN`: the same value as the endpoint's `PREVIEW_TOKEN`
   - `CMS_ADMIN_EMAIL`, `CMS_ADMIN_PASSWORD` for the first admin
   - Mixcloud, Spotify and YouTube credentials (Phase 7)
6. **Run once:**
   ```sh
   php artisan migrate --force
   php artisan db:seed --class=AdminUserSeeder --force
   php artisan db:seed --class=ReferenceSeeder --force
   php artisan storage:link
   php artisan config:cache && php artisan route:cache && php artisan view:cache
   ```
   If the host forbids symlinks, ask them to allow `storage:link`, or point `/storage` to `storage/app/public` in the panel.
7. **Add the cron entry** above.
8. **After an import** (step 9) or a database upload, run `php artisan endpoint:warm --all` once, so the API serves the new content immediately.
9. **Upload the media.** Uploaded files (images and release preview tracks) live in `storage/app/public/`, which is git-ignored and never part of the code upload. Copy that folder to the server's `storage/app/public/` by SFTP or the file manager. Locally it has already been filled by the importer: `media/` from the WordPress uploads, `tracks/` from `wp-content/uploads/tracks`.
10. **Import the content** (first time only, if you don't upload a copy of the database): `php artisan cms:import-wordpress`, then `php artisan cms:verify-import`. This needs the WordPress database (`WP_DB_*`) and the WordPress uploads folder (`WP_UPLOADS_PATH`).

## Later deployments

```sh
php artisan down
# upload code / git pull, upload public/build/
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan up
```

No worker restart is needed: every worker lives for less than a minute and picks up the new code on the next cron run.

## Backups

Back up the database and `storage/app/public` (uploaded media) regularly, and copy them off the server.
