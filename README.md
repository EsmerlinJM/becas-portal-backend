# BACKEND PORTAL NACIONAL DE BECAS
<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="400"></a></p>
<p  align="center">
<a  href="https://travis-ci.org/laravel/framework"><img  src="https://travis-ci.org/laravel/framework.svg"  alt="Build Status"></a>
<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/dt/laravel/framework"  alt="Total Downloads"></a>
<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/v/laravel/framework"  alt="Latest Stable Version"></a>
<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/l/laravel/framework"  alt="License"></a>
</p>

  

## Portal Nacional de Becas

Instalar localmente:

- Composer Install
- cp .env.example .env
- asignar base de datos
- asignar usuario al motor de base de datos
- asignar clave para motor de base de datos
- php database:create {database_name}
- php artisan key:generate
- php artisan migrate --seed
- php passport:install

## Deploy on Server:

Asumiendo deploy de la app en nginx, en /var/www/html:<br>
- sudo chmod -R 777 /var/www/html
- sudo chown -R www-data:www-data /var/www/html
- sudo usermod -a -G www-data root
- sudo find /var/www/html -type f -exec chmod 644 {} \;
- sudo find /var/www/html -type d -exec chmod 755 {} \;
- cd /var/www/html
- sudo chgrp -R www-data storage bootstrap/cache
- sudo chmod -R ug+rwx storage bootstrap/cache

## Documentacion API:
-  [API Documentacion Postman](https://documenter.getpostman.com/view/12386329/Tzm5JxHu)

  
## Datos Configuracion Instancia:
- PHP Version: 8.0.7
- Laravel Version: 8.49.0
- Motor Base de datos MySQL 8.0

## ARCHIVO ENV

### APP VARIABLES
- APP_NAME={ app_name }
- APP_ENV={ local } #local or production
- APP_KEY={ laravel_key } #php artisan key:generate
- APP_DEBUG= { true } #true or false
- APP_URL= { full_url } #http://localhost

### DATABASE CONNECTION
- DB_HOST={ host }
- DB_PORT={ port }
- DB_DATABASE={ dbName }
- DB_USERNAME={ db_user_name }
- DB_PASSWORD={ db_password }

### CLOUD STORAGE GOOGLE (BUCKET) :
- GOOGLE_CLOUD_PROJECT_ID={ project_id } #ID Name of Google Project
- GOOGLE_CLOUD_KEY_FILE='../google_credentials.json'
- GOOGLE_CLOUD_STORAGE_BUCKET={ google_storage_bucket_name } #Google Storage Bucket

### TOKEN SECRET
- TOKEN_SECRET={ 'token_secret_pass' }

### PASSPORT KEYS
- PASSPORT_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
{private key here}
-----END RSA PRIVATE KEY-----"
- PASSPORT_PUBLIC_KEY="-----BEGIN PUBLIC KEY-----
{public key here}
-----END PUBLIC KEY-----"

### MAIL CONFIGURATION

- MAIL_MAILER={ smtp }
- MAIL_HOST={ mailhog }
- MAIL_PORT={ 1025 }
- MAIL_USERNAME={ user_name }
- MAIL_PASSWORD= { password }
- MAIL_ENCRYPTION= { encryption } #SSL or TLS
- MAIL_FROM_ADDRESS= { from_email@here.com }
