**Установка**
- Установить PHP <a>https://www.php.net/downloads</a>
- Установить Nodejs <a>https://nodejs.org/en/download</a> **Не меньше 19 версии**
- Установить Composer <a>https://getcomposer.org/</a>
- Клонировать репозиторий `git clone <link>`
- Скачать модули node `npm install`
- Установить composer `Composer i`
---
**Запуск**
- Создать файл конфигурации с примера `Copy .env.example .env`
*Файл .env* <br> - Отредактировать файл конфигурации
>oauth.yandex.ru <br>
![image](https://github.com/user-attachments/assets/7eadc153-931c-47d6-a3b6-b0c5c44e175f)

- Создать ключ приложения `php artisan key:generate`
- Мигрировать таблицы `php artisan migrate`
- Запустить приложения `npm run dev` и `php artisan serve`

---
- Генерация пользователей `php artisan db:seed`
- Запуск тестов `npm run dev` и `php artisan test`
