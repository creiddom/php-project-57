#!/usr/bin/env bash

set -euo pipefail

if ! command -v psql >/dev/null 2>&1; then
    echo "psql не найден — пропускаем настройку тестовой БД"
    exit 0
fi

psql -d postgres -v ON_ERROR_STOP=1 <<'SQL'
DO $$
BEGIN
    CREATE ROLE "user" WITH LOGIN PASSWORD 'password' CREATEDB;
EXCEPTION
    WHEN duplicate_object THEN NULL;
END
$$;
SQL

if ! psql -d postgres -tAc "SELECT 1 FROM pg_database WHERE datname = 'laravel'" | grep -q 1; then
    psql -d postgres -c 'CREATE DATABASE laravel OWNER "user";'
fi

echo "Тестовая БД PostgreSQL готова (user / laravel)"
