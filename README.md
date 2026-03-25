# VeneKa Beauty - Project Setup

This project uses Laravel 12 + MySQL (XAMPP) and can run in two modes:

- **Recommended:** import the provided dataset from `database/entregable1.sql`
- **Alternative:** run a clean database with migrations and seeders

---

## 1) Requirements

- PHP 8.2+
- Composer
- MySQL / MariaDB (XAMPP)
- Node.js + npm (for frontend assets)

---

## 2) Install dependencies

```bash
composer install
npm install
```

Create your env file if needed:

```bash
cp .env.example .env
php artisan key:generate
```

---

## 3) Database setup (recommended: import `entregable1.sql`)

### 3.1 Configure `.env`

Use this locale block:

```dotenv
APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=en_US
```

Use this database block:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=entregable1
DB_USERNAME=root
DB_PASSWORD=
```

Because `entregable1.sql` does not include framework tables like `sessions`, `cache`, and `jobs`, use:

```dotenv
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

### 3.2 Create and import the database

From project root:

```bash
mysql -u root -h 127.0.0.1 -P 3306 -e "CREATE DATABASE IF NOT EXISTS entregable1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -h 127.0.0.1 -P 3306 --database=entregable1 --execute="SOURCE database/entregable1.sql"
```

### 3.3 Clear config cache

```bash
php artisan optimize:clear
```

> If you import `entregable1.sql`, **do not run** `php artisan migrate` on that same database unless you know exactly which migrations are pending.

---

## 4) Local product image storage

Product images are stored on the local `public` disk (see `ImageLocalStorage`) and exposed through `/storage`.

Run once:

```bash
php artisan storage:link
```

Notes:

- Uploaded images are saved under `storage/app/public/products`.
- SQL data references image paths like `products/default.png`; make sure your public storage has that file if your dataset expects it.

---

## 5) Run the app

```bash
php artisan serve
```

Open:

`http://127.0.0.1:8000`

---

## 6) Optional: clean database mode (without SQL import)

If you prefer a clean environment:

1. Set `DB_DATABASE` to a fresh database name.
2. Set drivers back to database mode if desired (`SESSION_DRIVER=database`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`).
3. Run:

```bash
php artisan migrate
php artisan db:seed
```

Use this mode only when you do **not** import `entregable1.sql`.
