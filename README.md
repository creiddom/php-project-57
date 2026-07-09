### Hexlet tests and linter status:
[![Actions Status](https://github.com/creiddom/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/creiddom/php-project-57/actions)
[![Linter and Tests](https://github.com/creiddom/php-project-57/actions/workflows/main.yml/badge.svg)](https://github.com/creiddom/php-project-57/actions/workflows/main.yml)
[![SonarQube Cloud](https://sonarcloud.io/images/project_badges/sonarcloud-light.svg)](https://sonarcloud.io/summary/new_code?id=creiddom_php-project-57)

### Задеплоенное приложение

[Менеджер задач](https://php-project-57-q8e4.onrender.com)

### Деплой на Render

Проект использует `Dockerfile`, в котором уже есть `npm run build`. После каждого пуша в `main` Render должен пересобрать образ.

На Render в Environment задайте:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://php-project-57-q8e4.onrender.com` (ваш URL, обязательно `https://`)
- `APP_KEY` — сгенерируйте локально: `php artisan key:generate --show`
- переменные PostgreSQL от Render (`DB_CONNECTION=pgsql`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

Если стили не применяются после деплоя:

1. Убедитесь, что в Build Logs есть шаг `npm run build`.
2. Проверьте, что `APP_URL` начинается с `https://`.
3. Запустите **Manual Deploy → Clear build cache & deploy**.

### Требования

- PHP >= 8.4
- Composer
- PostgreSQL
- Node.js >= 18

### Установка

```bash
git clone https://github.com/creiddom/php-project-57.git
cd php-project-57
make setup
```

### Запуск

```bash
php artisan migrate:refresh --seed --force
make start
```

Откройте http://127.0.0.1:8000/

### Настройка PostgreSQL

Приложение и тесты ожидают PostgreSQL с параметрами из `.env.example`:

- пользователь: `user`
- пароль: `password`
- база: `laravel`

`make test` автоматически создаёт роль и базу, если их ещё нет (нужен локальный `psql` с правами суперпользователя).

Для приложения вручную:

```bash
make test-db-setup
make migrate
```

### Линтер и тесты

```bash
make lint
make test
```
