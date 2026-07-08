#!/usr/bin/env bash

set -euo pipefail

DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-5432}"
DB_USER="${DB_USERNAME:-user}"
DB_PASSWORD="${DB_PASSWORD:-password}"
DB_NAME="${DB_DATABASE:-laravel}"

if ! command -v psql >/dev/null 2>&1; then
    echo "psql не найден — пропускаем настройку тестовой БД"
    exit 0
fi

if PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -c 'SELECT 1' >/dev/null 2>&1; then
    echo "Тестовая БД PostgreSQL готова ($DB_USER@$DB_HOST/$DB_NAME)"
    exit 0
fi

admin_psql() {
    if psql -h "$DB_HOST" -p "$DB_PORT" -d postgres -c 'SELECT 1' >/dev/null 2>&1; then
        psql -h "$DB_HOST" -p "$DB_PORT" -d postgres "$@"
    else
        psql -d postgres "$@"
    fi
}

admin_psql -v ON_ERROR_STOP=1 <<'SQL'
DO $$
BEGIN
    CREATE ROLE "user" WITH LOGIN PASSWORD 'password' CREATEDB;
EXCEPTION
    WHEN duplicate_object THEN NULL;
END
$$;
SQL

if ! admin_psql -tAc "SELECT 1 FROM pg_database WHERE datname = 'laravel'" | grep -q 1; then
    admin_psql -c 'CREATE DATABASE laravel OWNER "user";'
fi

echo "Тестовая БД PostgreSQL готова ($DB_USER@$DB_HOST/$DB_NAME)"
