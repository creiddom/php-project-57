### Hexlet tests and linter status:
[![Actions Status](https://github.com/creiddom/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/creiddom/php-project-57/actions)
[![Linter and Tests](https://github.com/creiddom/php-project-57/actions/workflows/main.yml/badge.svg)](https://github.com/creiddom/php-project-57/actions/workflows/main.yml)
[![SonarQube Cloud](https://sonarcloud.io/images/project_badges/sonarcloud-light.svg)](https://sonarcloud.io/summary/new_code?id=creiddom_php-project-57)

### Задеплоенное приложение

[Менеджер задач](https://php-project-57-q8e4.onrender.com)

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
