# Мейіржан бөбекжай

Сайт детского сада и CMS на Laravel 13, Inertia 3 и Vue 3.

## Требования

- PHP 8.3+ с PDO, mbstring, fileinfo, GD и SQLite или MySQL
- Composer 2
- Node.js 20+

## Локальный запуск

1. Заполните `SEED_ADMIN_EMAIL` и `SEED_ADMIN_PASSWORD` в `.env`.
2. Выполните `composer setup`.
3. Запустите `composer dev`.

Админ-панель доступна по адресу `/admin`. Загруженные файлы хранятся
на публичном диске Laravel; `composer setup` создаёт необходимую ссылку.

## Проверка

```bash
composer ci:check
```

Для тестов необходим драйвер `pdo_sqlite`. Тестовая база работает в памяти
и не затрагивает локальные или production-данные.

## Production

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan storage:link --force
php artisan optimize
```

Установите `APP_ENV=production`, `APP_DEBUG=false`, корректные `APP_URL`,
настройки базы, почты и очередей. Корень веб-сервера должен указывать на
каталог `public`. После первого деплоя выполните `php artisan db:seed
--class=AdminSeeder --force`, затем удалите пароль администратора из
переменных окружения.
