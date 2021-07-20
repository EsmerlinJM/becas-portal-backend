<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Portal Nacional de Becas Monolith

Instalar localmente:

-   Composer Install
-   cp .env.example .env
-   php artisan key:generate
-   php artisan migrate
-   Ver UML de las Clases: http://localhost/uml

Documentacion API:

-   [API Documentacion Postman](https://documenter.getpostman.com/view/12386329/Tzm5JxHu)

Datos Configuracion Instancia:

-   PHP Version: 8.0.7
-   Laravel Version: 8.49.0
-   Motor Base de datos MySQL 8.0

CLOUD STORAGE GOOGLE (CDN) (VALORES EN ENV):

-   GOOGLE_CLOUD_PROJECT_ID={{ ID DEL PROYECTO }}
-   GOOGLE_CLOUD_KEY_FILE={{ LOCACION ARCHIVO DE CREDENCIALES EJEMPLO: '../google_credentials.json' }}
-   GOOGLE_CLOUD_STORAGE_BUCKET={{ NOMBRE DEL BUCKET EN GOOGLE CLOUD }}
