# Это тестовое задание на вакансию junior php laravel разработчика

## Установка

Клонирование репозитория:

```bash
git clone https://github.com/NikolaiProgramist/keep-code-test-assignment.git
cd keep-code-test-assignment
```

Создайте пустую базу данных `Mysql` и введите данные для подключения к ней в `.env.example` файле:

```php
DB_DATABASE=db_name
DB_USERNAME=username
DB_PASSWORD=password
```

Далее переименуйте файл `.env.example` в `.env`:

```bash
mv .env.example .env
```

Установите зависимости:

```bash
composer install
```

Накатите миграции:

```bash
php artisan migrate
```

Заполните таблицы тестовыми данными:

```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=CarSeeder
```

Запустите сервер:

```bash
php artisan serve
```

Запустите фоновые `schedule` задачи:

```bash
php artisan schedule:work
```

Это необходимо для автоматического удаления просроченных токенов,
а также удаления просроченной аренды.

После всего проделанного, вы сможете получить доступ к api на `localhost:8000/api/v1/`.

Вы также можете использовать коллекцию `postman` для тестирования.
Она располагается в директории `files/`.
