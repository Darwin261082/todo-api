odo-api (Backend PHP + MySQL)
# ToDo API Backend

Aplicación backend para la gestión de tareas, implementada en **PHP 8+** con arquitectura **Hexagonal**, **SOLID**, **CQRS** y autenticación **JWT**.

## Requisitos

- PHP 8+
- Composer
- MySQL o MariaDB
- XAMPP / MAMP / WAMP o similar

## Instalación

1. Clonar el repositorio:

```bash
git clone <REPO_URL>
cd todo-api

Instalar dependencias con Composer:

composer install

Configurar la base de datos:

Crear base de datos todo_db

Crear tablas:

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(255),
  completed BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

Configurar conexión en src/Infrastructure/Database.php:

$host = 'localhost';
$db = 'todo_db';
$user = 'root';
$pass = '';

Probar endpoint de prueba:

http://localhost/todo-api/public/index.php/api/test

Debe devolver algo como:

{"message":"API funcionando"}
Endpoints
Método	Ruta	Descripción
POST	/api/register	Registrar usuario
POST	/api/login	Login y generar JWT
GET	/api/tasks	Listar tareas del usuario (JWT requerido)
POST	/api/tasks	Crear tarea (JWT requerido)
PUT	/api/tasks/{id}	Actualizar tarea (JWT requerido)
DELETE	/api/tasks/{id}	Eliminar tarea (JWT requerido)
Notas

Autenticación mediante JWT con expiración.

Arquitectura hexagonal: src/Application, src/Domain, src/Infrastructure, src/Shared.

CQRS implementado en commands y queries.
