@AGENTS.md

# DJ Fabrizia Backoffice v2

Filament 5 back office that replaces the WordPress/ACF back office in `../djfabrizia-backoffice`, which stays running (DJ_BACKOFFICE, port 5050) as the import source and as the reference for comparing behaviour until the transition is complete. The full plan is `../djfabrizia-endpoint/CMS_PLAN.md`; its §0 working constraints override anything else in it.

## Project rules

- This app owns the content schema in the `djfabriz_cms` database. The endpoint (`../djfabrizia-endpoint`) reads it with a read-only user, so schema changes are expand/contract only: never rename or drop a column in one step.
- Shared models, backed enums and block DTOs live in `packages/content` (`djfabrizia/content`). The endpoint requires the same package.
- Production is shared hosting and deployment is manual and out of scope. Ignore the Laravel Cloud deployment guideline above. Code must work with cron-driven `schedule:run`, the `database` queue and cache drivers, and no long-running daemons or Redis.
- Media uses Laravel `Storage` on the `public` disk. Never build media URLs by hand.
- Tests are PHPUnit only (no Pest). Faker factories for test data.
- Larastan runs at level 8 with no baseline.

## Running commands

Everything runs inside Docker. The compose file lives in `../djfabrizia-endpoint/docker-compose.yml`.

```sh
docker exec DJ_BACKOFFICE_V2 php artisan <command>
docker exec DJ_BACKOFFICE_V2 php artisan test --compact
docker exec DJ_BACKOFFICE_V2 composer lint
```

- Web: http://localhost:6060 (panel at `/admin`). Queue and scheduler run in DJ_BACKOFFICE_V2_QUEUE and DJ_BACKOFFICE_V2_SCHEDULER.
- Frontend assets: `docker run --rm -v "$PWD":/app -w /app node:22-alpine npm run build`, or `docker compose --profile vite up djbackofficev2-vite` for HMR.
- DB users and databases: `docker/scripts/bootstrap-db.sh` (re-run after migrations to apply the `bookings` INSERT grant).
