#!/usr/bin/env bash
#
# Create the databases and least-privilege users used by the new back office and
# the endpoint, inside the shared DJ_DB MariaDB container (local development).
#
# Idempotent: safe to re-run. Passwords are read from this project's .env and are
# never written to a committed file. Run it again after `php artisan migrate` so
# the table-level INSERT grant on `bookings` can be applied (MariaDB refuses a
# table grant for a table that does not exist yet).
#
# Usage: docker/scripts/bootstrap-db.sh
#   DB_CONTAINER (default DJ_DB) and DB_ROOT_PASSWORD (default "password", as in
#   djfabrizia-endpoint/docker-compose.yml) can be overridden from the environment.

set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
ENV_FILE="${ROOT_DIR}/.env"
DB_CONTAINER="${DB_CONTAINER:-DJ_DB}"
DB_ROOT_PASSWORD="${DB_ROOT_PASSWORD:-password}"

env_value() {
    local value
    value="$(grep -E "^$1=" "${ENV_FILE}" | tail -n1 | cut -d= -f2- | sed -e 's/^"//' -e 's/"$//')"
    if [ -z "${value}" ]; then
        echo "Missing $1 in ${ENV_FILE}" >&2
        exit 1
    fi
    printf '%s' "${value}"
}

sql_quote() {
    printf "'%s'" "$(printf '%s' "$1" | sed "s/'/''/g")"
}

CMS_PASSWORD="$(sql_quote "$(env_value DB_PASSWORD)")"
IMPORTER_PASSWORD="$(sql_quote "$(env_value WP_DB_PASSWORD)")"
ENDPOINT_RO_PASSWORD="$(sql_quote "$(env_value ENDPOINT_RO_PASSWORD)")"
ENDPOINT_RW_PASSWORD="$(sql_quote "$(env_value ENDPOINT_RW_PASSWORD)")"

run_sql() {
    docker exec -i "${DB_CONTAINER}" mariadb -uroot -p"${DB_ROOT_PASSWORD}" --batch --skip-column-names 2>/dev/null
}

# Database names are escaped (`\_`) in GRANT statements: an unescaped `_` is a
# wildcard in MariaDB database-level grants.
run_sql <<SQL
CREATE DATABASE IF NOT EXISTS djfabriz_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE IF NOT EXISTS djfabriz_cms_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE IF NOT EXISTS djfabriz_endpoint CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'cms_rw'@'%' IDENTIFIED BY ${CMS_PASSWORD};
ALTER USER 'cms_rw'@'%' IDENTIFIED BY ${CMS_PASSWORD};
GRANT ALL PRIVILEGES ON \`djfabriz\_cms\`.* TO 'cms_rw'@'%';
GRANT ALL PRIVILEGES ON \`djfabriz\_cms\_test\`.* TO 'cms_rw'@'%';

CREATE USER IF NOT EXISTS 'importer_ro'@'%' IDENTIFIED BY ${IMPORTER_PASSWORD};
ALTER USER 'importer_ro'@'%' IDENTIFIED BY ${IMPORTER_PASSWORD};
GRANT SELECT ON \`djfabriz\_headless\`.* TO 'importer_ro'@'%';

CREATE USER IF NOT EXISTS 'endpoint_ro'@'%' IDENTIFIED BY ${ENDPOINT_RO_PASSWORD};
ALTER USER 'endpoint_ro'@'%' IDENTIFIED BY ${ENDPOINT_RO_PASSWORD};
GRANT SELECT ON \`djfabriz\_cms\`.* TO 'endpoint_ro'@'%';
GRANT SELECT ON \`djfabriz\_cms\_test\`.* TO 'endpoint_ro'@'%';

CREATE USER IF NOT EXISTS 'endpoint_rw'@'%' IDENTIFIED BY ${ENDPOINT_RW_PASSWORD};
ALTER USER 'endpoint_rw'@'%' IDENTIFIED BY ${ENDPOINT_RW_PASSWORD};
GRANT ALL PRIVILEGES ON \`djfabriz\_endpoint\`.* TO 'endpoint_rw'@'%';

FLUSH PRIVILEGES;
SQL

for database in djfabriz_cms djfabriz_cms_test; do
    has_bookings="$(echo "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '${database}' AND table_name = 'bookings';" | run_sql)"
    if [ "${has_bookings}" = "1" ]; then
        echo "GRANT INSERT ON \`${database}\`.\`bookings\` TO 'endpoint_ro'@'%'; FLUSH PRIVILEGES;" | run_sql
        echo "Granted INSERT on ${database}.bookings to endpoint_ro"
    else
        echo "Skipped INSERT grant on ${database}.bookings (table not migrated yet; re-run after migrate)"
    fi
done

echo "Databases and users are ready."
