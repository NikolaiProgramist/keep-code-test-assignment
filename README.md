# Это тестовое задание на вакансию junior php laravel разработчика

[![Maintainability](https://qlty.sh/badges/d2b62576-cd0d-4d3e-8a39-84f720b19ecc/maintainability.svg)](https://qlty.sh/gh/NikolaiProgramist/projects/keep-code-test-assignment)

Ниже вы можете посмотреть схему проекта.

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

В базе данных присутствует администратор, вот его данные для аутентификации:

email: admin@mail.ru
password: test1234

Вы также можете использовать коллекцию `postman` для тестирования.
Она располагается в директории `files/`.

## Схема проекта

Маршруты:

![Маршруты](files/images/routes.png)

База данных:

![База данных](files/images/db.png)

Формула подсчёта лимита часов для продления аренды:

![Формула лимита часов](files/images/formul.png)
