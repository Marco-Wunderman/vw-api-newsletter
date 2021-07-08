
# API Newsletter Volkswagen México

API desarrollada para registrar a los usuarios que desean estar inscritos al Newsletter de Volkswagen México

## Tecnologías 🛠️

 - Composer  [Sitio oficial de Composer](https://getcomposer.org/)
 - Laravel 7.30.4 [Sitio Oficial de Laravel (Ver Requisitos)](https://laravel.com/docs/7.x#server-requirements)
 - PHP>= 7.2.5
 - MySQL

## Instalación 🔧

1. Primero necesitamos instalar composer el cual es el gestor de paquetes para PHP, la instalación varía dependiendo el sistema operativo en el que se va a trabajar. *Ver* [Descarga Composer](https://getcomposer.org/download/)
2. Teniendo composer instalado, procedemos a descargar e instalar Laravel, el cual se instala a traves de composer, para ello abrimos la terminal del sistema operativo y ejecutamos el siguiente comando `composer global require laravel/installer` 
3. Abrimos la terminal  del sistema operativo que estemos usando en el espacio de trabajo donde vayamos a clonar el repositorio y ejecutamo el siquiente comando `git clone https://github.com/Marco-Wunderman/vw-api-newsletter.git` 

## Entorno de Desarrollo 🚀
> Se asume que previamente ya se tiene instalado un ambiente LAMP y que este ya esta funcional, esto con ayuda de algún paquete libre como XAMPP o bien tener instalado cada tecnología de manera individual.

 1. Dentro del la carpeta del proyecto previamente clonado ejecutamos el comando `composer install` el cual ayudara a instalar todos los paquetes de PHP que necesita el proyecto.
 2. Configuramos el archivo *.env* el cual esta en la raíz del proyecto de no encontrarse crear una copia del archivo *.env.example* y reenombrar la copia del archivo con el nombre *.env*, procedemos a ingresar la credenciales de la base de datos   <p> <ul><li>DB_DATABASE = NOMBRE_BD</li><li>DB_USERNAME = USUARIO_BD</li><li>DB_PASSWORD=PASSWORD_BD</li></ul> </p>
 3. Procedemos a correr el comando `php artisan serve` el cual levantara el servidor de laravel. 
 4. Abrimos una nueva terminal para no interrumpir el proceso del servidor y en la nueva terminal corremos las migraciones con el comando `php artisan migrate` el cual creara las tablas en la base de datos con sus respectivos campos.
 5. Por ultimo en nuestro navegador ingresamos a la url: http://127.0.0.1:8000

## API Endpoints 🔵
Para hacer uso del API se debe de enviar una API KEY la cual se enviara como parametro en cada una de las urls de los endpoints
Variable                          |Valor                         |
|----------------|-------------------------------|-----------------------------|
api_key            |key_cur_prod_fnPqT5xQEi5Vcb9wKwbCf65c3BjVGyBB

#### Endpoints Suscriber
 > Store (insertar registro)

```sh
http://127.0.0.1:8000/api/suscriber?api_key=key_cur_prod_fnPqT5xQEi5Vcb9wKwbCf65c3BjVGyBB
```
**Parametros de entrada - JSON**

 - name - string 
 - email - string 
 - notice_of_privacy - integer - Valor esperado: 1

**Respuestas:**

**200**
Retornara la información con la cual se creo el registro en formato JSON
```sh
{
	"name",
	"email",
	"notice_of_privacy",
	"updated_at",
	"created_at",
	"id"
}
```

**400**
Este error se presenta cuando se hizo  una mala solicitud, derivado por algún dato enviado de manera erronea, se regresa una matriz de objetos con los errores encontrados con el siguiente formato:
```sh
"errors":  {
	"campo":  ["Valor"]
}
