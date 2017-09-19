<p align="center"><img src="http://megacreativo.com/assets/img/creative/logo-creative.png" width="400"></p>

<p align="center">

<a href="https://travis-ci.org/megacreativo/creative"><img src="https://travis-ci.org/megacreativo/creative.svg?branch=master" alt="Build Status"></a>

<a href="https://packagist.org/packages/megacreativo/creative"><img src="https://poser.pugx.org/megacreativo/creative/license" alt="License"></a>

<a href="https://travis-ci.org/megacreativo/creative"><img src="https://poser.pugx.org/megacreativo/creative/downloads" alt="Total Downloads"></a>

<a href="https://travis-ci.org/megacreativo/creative"><img src="https://poser.pugx.org/megacreativo/creative/v/unstable" alt="Latest Unstable Version"></a>

<a href="https://packagist.org/packages/megacreativo/creative"><img src="https://poser.pugx.org/megacreativo/creative/v/stable" alt="Latest Stable Version"></a>

</p>

# Creative Framework

## A cerca de  Creative

Creative es un framework para la creación de Aplicaciones Web. Creative es sencillo, pero potente, proporcionando las herramientas necesarias para aplicaciones grandes y robustas.


## Instalación
La forma más fácil de instalar Creative es usar [Composer](https://github.com/composer/composer)

```javascript
composer create-project megacreativo/creative
```

## Contribución

¡Gracias por considerar contribuir al proyecto de Creative. Envíe un correo electrónico a Brayan Rincon a brincon@megacreativo.com para considerar su contribución.

## Vulneravilidad de seguridad

Si descubre alguna vulnerabilidad de seguridad dentro de Creative, envíe un correo electrónico a Brayan Rincon a brincon@megacreativo.com. Todas las vulnerabilidades de seguridad serán atendidas rápidamente.

## License

The Creative Framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).



## Configuraciones
> setting.json

```javascript
    {
        // Hash único de cada aplicación esta es utilizada 
        // como llave para encriptar y desencriptar 
        // las contraseñas y en la base de datos, encriptación de sesiones.
        "hash_key": "2468b70f-a170-4c6f-a678-9f5039f4310c",

        // Carpeta con acceso a la web.
        "public_html": "public_html",

        "use_generator": false,

        // Entorno de desarrollo [development, production]
        "environment": "development",

        // E-mail de contacto por defecto.
        "email_contact": "info@mail.com",

        // Email de contacto del Webmastes.
        "email_webmaster": "webmaster@mail.com",
        
        // Permitir rediririgir al metodo por defecto 
        // en caso con el controlador no exista.
        "redirect_default_method": false,

        // Zona horaria de la aplciación.
        "timezone": "america\/caracas",

        // Lenguaje por defecto de la aplciación, 
        // esta es usada en la etiqueta <html lang="es_ve">.
        "default_lang": "es",

        // Driver por defecto para conexión con la bas de datos
        // [mysql (MySQL), mssql (MS SQL Server), pgsql (PostgreSQL)].
        "db_driver_database": "mysql",
        "db_host": "localhost",
        "db_database": "db",
        "db_user": "user",
        "db_password": "password",
        "db_port": "3306",
        "db_charset": "utf8_general_ci",
        "db_collate": "utf8"
    }
```