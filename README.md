# Backend Portal Nacional de Becas

<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="400"></a></p>
<p  align="center">
<a  href="https://travis-ci.org/laravel/framework"><img  src="https://travis-ci.org/laravel/framework.svg"  alt="Build Status"></a>
<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/dt/laravel/framework"  alt="Total Downloads"></a>
<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/v/laravel/framework"  alt="Latest Stable Version"></a>
<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://img.shields.io/packagist/l/laravel/framework"  alt="License"></a>
</p>

## Descripción y contexto
---
Esta nueva versión del Programa de Becas Dominicano responde  por un lado, a la política de fortalecimiento de las Instituciones Públicas que el actual gobierno tiene como una de sus metas y, por el otro lado, se requiere dar respuesta a la necesidad de emitir una nueva regulación que contribuya a la gestión común de las convocatorias, los servicios y procedimientos que los diferentes programas de Becas nacionales e internacionales de los Ministerios y Direcciones Generales del Gobierno ofrecen a la población dominicana para contribuir de forma efectiva a la formación de los especialistas que requiere el país para su desarrollo social y productivo.
## API Reference

-  [API Documentacion Postman](https://documenter.getpostman.com/view/12386329/Tzm5JxHu)

  En el repositorio se encuentra la collecion de Postman para importacion, en caso de ser necesaria.
  En el folder ./postman en el root del repositorio.
  
## Authors
### Quienes han trabajado en el proyecto

Agosto 2021
- Ivan Firestone - [@ifirestone](https://www.github.com/ifirestone)


## Deployment 

- Composer Install
- cp .env.example .env
- asignar base de datos
- asignar usuario al motor de base de datos
- asignar clave para motor de base de datos
- php database:create {database_name}
- php artisan key:generate
- php artisan migrate --seed
- php passport:install

Permisos en el Server asumiendo instalacion con NGINX
- sudo chmod -R 777 /var/www/html
- sudo chown -R www-data:www-data /var/www/html
- sudo usermod -a -G www-data root
- sudo find /var/www/html -type f -exec chmod 644 {} \;
- sudo find /var/www/html -type d -exec chmod 755 {} \;
- cd /var/www/html
- sudo chgrp -R www-data storage bootstrap/cache
- sudo chmod -R ug+rwx storage bootstrap/cache

  
## Documentation
- PHP Version: 7.4
- Laravel Version: 8.49.0
- Motor Base de datos: MySQL 8.0
- Passport: 10.1

Librerias:

#### Require
    -   php: "^7.3|^8.0"
    -   fideloper/proxy: "^4.4",
    -   fruitcake/laravel-cors: "^2.0",
    -   guzzlehttp/guzzle: "^7.0.1",
    -   laravel/framework: "^8.12",
    -   laravel/passport: "^10.1",
    -   laravel/tinker: "^2.5",
    -   superbalist/laravel-google-cloud-storage: "^2.2"

#### Require Dev
    
    -   andyabih/laravel-to-uml: "^1.0"
    -   facade/ignition: "^2.5"
    -   fakerphp/faker: "^1.9.1"
    -   laravel/sail: "^1.0.1"
    -   mockery/mockery: "^1.4.2"
    -   nunomaduro/collision: "^5.0"
    -   phpunit/phpunit: "^9.3.3"
    
## Environment Variables

Archivo .env

#### APP VARIABLES
- APP_NAME={ app_name }
- APP_ENV={ local } #local or production
- APP_KEY={ laravel_key } #php artisan key:generate
- APP_DEBUG= { true } #true or false
- APP_URL= { full_url } #http://localhost

#### DATABASE CONNECTION
- DB_HOST={ host }
- DB_PORT={ port }
- DB_DATABASE={ dbName }
- DB_USERNAME={ db_user_name }
- DB_PASSWORD={ db_password }

#### CLOUD STORAGE GOOGLE (BUCKET) :
- GOOGLE_CLOUD_PROJECT_ID={ project_id } #ID Name of Google Project
- GOOGLE_CLOUD_KEY_FILE='../google_credentials.json'
- GOOGLE_CLOUD_STORAGE_BUCKET={ google_storage_bucket_name } #Google Storage Bucket

#### TOKEN SECRET
- TOKEN_SECRET={ 'token_secret_pass' }
#### LANDINGS
LADING_AFTER_EMAIL_CONFIRMATION={ 'url_where_to_land' }
LADING_AFTER_PASSWORD_RESET={ 'url_where_to_land' }
LADING_AFTER_TOKEN_EXPIRED={ 'url_where_to_land' }
LADING_AFTER_EMAIL_CONFIRMATION={ 'url_where_to_land' }

#### PASSPORT KEYS
- PASSPORT_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
{private key here}
-----END RSA PRIVATE KEY-----"
- PASSPORT_PUBLIC_KEY="-----BEGIN PUBLIC KEY-----
{public key here}
-----END PUBLIC KEY-----"

#### MAIL CONFIGURATION

- MAIL_MAILER={ smtp }
- MAIL_HOST={ mailhog }
- MAIL_PORT={ 1025 }
- MAIL_USERNAME={ user_name }
- MAIL_PASSWORD= { password }
- MAIL_ENCRYPTION= { encryption } #SSL or TLS
- MAIL_FROM_ADDRESS= { from_email@here.com }  
## FAQ


#### Question 1

Answer 1

#### Question 2

Answer 2

  
## Aplicacion

Aplicacion Web, responsive.

- Portal Ciudadano: registro del Ciudadano para poder aplicar a becas a traves del Meysct
- BackOffice: portal de gestion del Meysct para la evaluacion de de las solicitudes de los candidatos a las becas, la publicacion de convocatorias y ofertas academicas en estas. Usado por las instituciones donde se cursan las becas para asentar las calificaciones y anotaciones acerca de los becados.
- Backend: API que soporta tanto el Portal Ciudadano como el BackOffice.

  
## Usado por
-   Mescyt
-   Instituciones de Estudios Superiores
-   Patrocinadores de Becas (Oferentes)
-   Candidatos a las Becas (Ciudadanos)
  
## Tech Stack

**Client:** React, Redux, TailwindCSS

**Server:** Laravel

  
## Server

Proyecto desplegado en Google Cloud.
- Dominio: a definir
- Instancia Desarrollo: a definir

## Badges o escudos
---
Es común en muchos repositorios open source el uso de badges o escudos para dar visbilidad el uso de microservicios, licencias, descargas, etc. Recomendamos revisar la iniciativa https://shields.io/ donde según consideres necesario podrás generar badges para tu repo. 

### Ejemplos de badges

- code coverage percentage: ![coverage](https://img.shields.io/badge/coverage-80%25-yellowgreen)
- stable release version: ![version](https://img.shields.io/badge/version-1.2.3-blue)
- package manager release: ![gem](https://img.shields.io/badge/gem-2.2.0-blue)
- status of third-party dependencies: ![dependencies](https://img.shields.io/badge/dependencies-out%20of%20date-orange)
- static code analysis grade: ![codacy](https://img.shields.io/badge/codacy-B-green)
- [SemVer](https://semver.org/) version observance: ![semver](https://img.shields.io/badge/semver-2.0.0-blue)
- amount of [Liberapay](https://liberapay.com/) donations per week: ![receives](https://img.shields.io/badge/receives-2.00%20USD%2Fweek-yellow)
- Python package downloads: ![downloads](https://img.shields.io/badge/downloads-13k%2Fmonth-brightgreen)
- Chrome Web Store extension rating: ![rating](https://img.shields.io/badge/rating-★★★★☆-brightgreen)
- [Uptime Robot](https://uptimerobot.com) percentage: ![uptime](https://img.shields.io/badge/uptime-100%25-brightgreen)

### Badges que solicitamos:
---
En la iniciativa Código para el Desarrollo solicitamos a los equipos que suman sus herramientas al catálogo de sumar el badge generado por el uso del microservicio de evaluación estática de código SonarCloud.

El badge se ve así y redirige al reporte de evaluación estática del último commit de la herramienta:

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=EL-BID_guia-de-publicacion&metric=alert_status)](https://sonarcloud.io/dashboard?id=EL-BID_guia-de-publicacion)
