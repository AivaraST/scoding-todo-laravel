## Task Manager

Task Manager app with Vue and Laravel for practice purposes.

- [BackEnd (Laravel)](https://github.com/AivaraST/scoding-todo-laravel).
- [FrontEnd (Vue)](https://github.com/AivaraST/scoding-todo-vue).

## Start project
- Clone repository```git clone https://github.com/AivaraST/scoding-todo-laravel.git```
- Change directory into cloned project ```cd scoding-todo-laravel```
- Copy .env example file ```cp .env.example .env```
- Create database and change database name in your ```.env``` file to your created database name.
- Install dependencies ```composer install```
- Generate app key ```php artisan key:generate```
- Generate JWT key ```php artisan jwt:secret```
- Migrate database ```php artisan migrate``` or migrate with seeds ```php artisan migrate --seed```

## Todo Later
- [ ] Make admin as roles in different table. 
