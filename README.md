API REST para gestión de tareas. Implementa autenticación con JWT y permite CRUD de tareas.

---

## 📦 Tecnologías

- PHP 8+  
- MySQL / MariaDB  
- Composer (para dependencias, como `firebase/php-jwt`)  
- Arquitectura Hexagonal + CQRS  
- JSON Web Tokens (JWT) para autenticación  

---

## ⚡ Requisitos

- XAMPP, MAMP, LAMP o cualquier servidor PHP local  
- Composer  
- Base de datos MySQL  

---

## 🚀 Instalación

1. Clonar repositorio:

```bash
git clone https://github.com/tu-usuario/todo-api.git
cd todo-api

Instalar dependencias PHP:

composer install

Configurar base de datos:

Crear base de datos todo_db (o la que desees).

Importar las tablas:

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

Configurar conexión en src/Infrastructure/Database.php.

Levantar servidor local (por ejemplo con XAMPP en htdocs/todo-api/public).

📌 Endpoints
Método	Endpoint	Descripción
POST	/api/register	Crear usuario
POST	/api/login	Login y generar JWT
GET	/api/tasks	Listar tareas del usuario (protegido)
POST	/api/tasks	Crear tarea (protegido)
PUT	/api/tasks/{id}	Actualizar tarea (protegido)
DELETE	/api/tasks/{id}	Eliminar tarea (protegido)
✅ Notas

Usar JWT para todas las rutas protegidas.

Arquitectura Hexagonal permite separar dominio, aplicación e infraestructura.

CQRS implementado: Commands y Queries separados para mantener claridad de operaciones.
