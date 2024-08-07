<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Framework: Laravel 11

## INSTALL

composer install

php:  >= 8.2

php artisan migrate

php artisan migrate --env=testing



### Execute API GPT

- **php artisan users:load**  este me carga los usuarios a la tabla
- **php artisan challenges:load**  este me carga los desafios a la tabla
- **php artisan videos:load**  este me carga los videos a la tabla

### Execute apis routes

En la raiz del proyecto existe un archivo llamado **insomnia_api.json** el cual se puede ejecutar en la aplicacion insomnia y traera la estructura para consultar cada endpoint

<img width="254" alt="Captura de pantalla 2024-08-06 a la(s) 4 54 24 p  m" src="https://github.com/user-attachments/assets/5f7ec4bf-bd8c-4ee7-ba73-28a0b4791abc">


### Execute tests

php artisan test


## .env.testing

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=testing_talentpitch

DB_USERNAME=root

DB_PASSWORD=root

## .env
Se debe agregar estas claves para que funcione openAI, estas funcionaran de manera temporal por tema de pruebas


## Heroku
https://talentpitch-bdc75c6805c9.herokuapp.com/

