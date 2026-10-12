# CRUD-CARS

Идея проекта: База данных для сбора простейших данных об автомобилях, в основе функционала проекта входит простой принцип CRUD(create, read, update, delete).

## Запуск

```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Затем открыть http://127.0.0.1:8000. База данных: SQLite (файл `database/database.sqlite`, настройка не нужна). На Windows вместо `cp` можно скопировать файл `.env.example` вручную и назвать `.env`.

## Поля таблицы `cars`

| Поле | Тип | Обязательное | Назначение |
|---|---|---|---|
| brand | string(50) | да | Марка |
| model | string(50) | да | Модель |
| release_year | unsignedSmallInteger | да | Год выпуска |
| release_month | unsignedTinyInteger | да | Месяц выпуска (1-12) |
| price | unsignedInteger | да | Цена при выпуске, USD |
| engine_displacement | decimal(3,1) | нет (nullable) | Объём двигателя, л |
| is_available | boolean | да (по умолчанию true) | Доступна ли для продажи |
| body_type_id | внешний ключ | да | Тип кузова |

Таблица `body_types` (справочник): `id`, `name` (уникальное). Значения из сидера: Sedan, SUV, Hatchback, Coupe, Wagon.

## Валидация

Выполняется на сервере через `$request->validate()` при создании и обновлении.

| Поле | Правила | Зачем |
|---|---|---|
| brand, model | required, string, max:50 | Не пустое и не длиннее столбца |
| release_year | required, integer, между 1886 и текущим годом | Ограничивающее поле: первая машина появилась в 1886 году, будущее невозможно |
| release_month | required, integer, 1-12 | Только настоящие месяцы |
| price | required, integer, min:0 | Цена не может быть отрицательной |
| engine_displacement | nullable, numeric, 0-99.9 | Необязательное, влезает в decimal(3,1) |
| is_available | required, boolean | Да или нет |
| body_type_id | required, exists:body_types,id | Нельзя подставить несуществующий тип кузова |

SQLite не проверяет `unsigned` и `decimal`, поэтому защита обеспечивается валидацией.

## Маршруты

`Route::resource('cars', CarController::class)`, плюс `/` перенаправляет на список.

| Метод | URI | Действие |
|---|---|---|
| GET | /cars | index (список, фильтр `?brand=`, пагинация) |
| GET | /cars/create | create (форма) |
| POST | /cars | store (сохранение) |
| GET | /cars/{car} | show (карточка, 404 если нет) |
| GET | /cars/{car}/edit | edit (форма) |
| PUT/PATCH | /cars/{car} | update (обновление) |
| DELETE | /cars/{car} | destroy (удаление) |

## Выбранная связь

Справочник `body_types` и связь `belongsTo` (у машины один тип кузова, у типа кузова много машин). Причина: значения хранятся в одном месте, их выбирают из списка, и опечаток нет. При удалении типа кузова с машинами база не даёт удалить (`restrictOnDelete`), чтобы не потерять данные.

## Сознательно не реализовано

- Авторизация, API, очереди, загрузка файлов, сторонние пакеты: их нет в задании, проект должен быть простым.
- Tailwind и Vite: достаточно простого CSS в шаблоне.
- Управление справочником типов кузова (CRUD): значения добавляются сидером.