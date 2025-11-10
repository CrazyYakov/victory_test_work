# Тестовая работа "Система управления заказам"

Это тестовое задание. Реализовать backend-часть мини-приложения для управления заказами на Laravel 12.

# Технические требования
- Docker
- PostgresSQL
- PHP 8.2
- Laravel 12

# Инструкция по запуску

## Предварительная установка
```shell
cp .env.example .env
```

В файл `.env` добавить значения:
```dotenv
USER_NAME=${USER}
USER_ID=${UID}
```

В файл `hosts` добавьте строку:
```text
127.0.0.1 victory.test
```

## Установка
```shell
docker compose up -d
```

# Запуск после установки
```shell
docker compose exec app composer i
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

# Проверить работу с тестовыми данными
```shell
docker compose exec app php artisan db:seed
```

# Запустить тесты
```shell
docker compose exec app php artisan test
```

# Сервисы Docker compose
- app
- postgres
- nginx
- queue

## app
Приложение на laravel.

## postgres
База данных. Основное хранилище.

## nginx
Сервер приложения.

## queue
Контейнер для работы с очередями.

# Структура

## DDD
Проект лежит в папке `src` и разработан по принципам Domain-Driven Design (DDD).
Проект поделен на следующие контексты по своим бизнес-задачам:

- Admin (Управление заказами и товарами)
- Auth (Аутентификация пользователя)
- Profile (Управление заказами текущего пользователя)
- Public (Публичная часть)

## Архитектура
Каждый контекст поделен на следующие слои:
- Application (Слой приложения)
- Domain (Бизнес-модель)
- Infrastructure (Инфраструктура: работа с БД, очередями и т.д.)
- Presentation (Взаимодействие с клиентом)

Структура каждого контекста выполнена следующим образом:
```
{Bounded Context}/
├── Applcation/
│   └── Actions
├── Domain/
│   ├── Aggregates
│   ├── Entities
│   └── Factories
├── Infrastructure/
│   ├── Managers
│   ├── Repositories
│   └── Services
└── Presentation/
    ├── Controllers
    ├── Requests
    └── Resoruces
```

# REST API 

## Auth

### Регистрация
`POST` - `/api/v1/auth/registration`
```json
{
    "email": "someone@mail.com",
    "password": "password"
}
```

### Авторизация
`POST` - `/api/v1/auth/authorization`
```json
{
    "email": "someone@mail.com",
    "password": "password"
}
```

## Profile

### Создать заказ
`POST` - `/api/v1/profile/orders`
```json
{
    "products": [
        {
            "id": 1,
            "quantity": 2
        }
    ]
}
```
### Просмотреть заказы
`GET` - `/api/v1/profile/orders`

### Просмотреть заказ
`GET` - `/api/v1/profile/orders/{order}`

## Public

### Просмотреть товары
`GET` - `/api/v1/public/products`

### Просмотреть товар
`GET` - `/api/v1/public/products/{product}`

## Admin

### Обновить статус заказа
`POST` - `/api/v1/admin/orders/{order}/change-status`
```json
{
    "status": "processing"
}
```

### Создать товар
`POST` - ` api/v1/admin/products`
```json
{
    "name": "name",
    "price": 1000.00
}
```

### Обновить товар
`POST` - ` api/v1/admin/products/{product}`
```json
{
    "name": "name",
    "price": 1000.00
}
```
