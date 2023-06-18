    Инструкция по установке

1. Для клонирования пропекта из репозитория в папке проекта выполнить команду
git clone git@github.com:Oleg1979k/test28.git

2. Перейти в папку test28 cd test28

3. Выполнить команду composer install

4. В корне проекта создать файл .env, скопировать в него содержимое файла .env.example

5. В файле .env настроить соединение с БД 

6. Применить миграции, выполнив команду php artisan migrate

7. Выполнить команду php artisan key:generate

8. Запустить web-сервер php artisan serve

9. В новом окне выполнить команды npm install и npm run dev

10. В браузере перейти по адресу http://127.0.0.1:8000/register и создать пользователя

11. Для создания автомобилей в браузере перейти по адресу http://127.0.0.1:8000/cars-ajax-crud
    Будет отображаться список автомобилей, созданных под этим пользователем

12. Для смены пользователя перейти по адресу http://127.0.0.1:8000/login и нажать logout. 
Для создпния нового пользователя см. п.10. Для аутентификации под существующим пользователем 
нужно перейти по адресу http://127.0.0.1:8000/login. 
