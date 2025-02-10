# Перед запуском

1. В директории config переименовать database.copy.php в database.php;
2. Указать данные для подключения к базе данных;
3. выполнить команду:
```
composer install
```
# Запуск

```bash
php -S localhost:8000 -t public
```