
# Prueba Técnica - API de Gestión de Alumnos

API RESTful desarrollada en Laravel para gestionar alumnos con autenticación JWT (Bearer Token).

---

## Tecnologías

- PHP 8.4
- Laravel 10
- JWT Auth (tymon/jwt-auth)
- MySQL (u otro motor de base de datos)

---

## Instalación

1. Clonar repositorio

```bash
git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo
```

2. Instalar dependencias

```bash
composer install
```

3. Configurar archivo `.env`

```env
APP_NAME=PruebaTecnica
APP_ENV=local
APP_KEY=base64:GENERAR_CLAVE
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_basedatos
DB_USERNAME=usuario
DB_PASSWORD=contraseña

JWT_SECRET=GENERAR_CON_JWT_SECRET
```

4. Generar clave de aplicación y JWT

```bash
php artisan key:generate
php artisan jwt:secret
```

5. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

---

## Uso

### Login

**URL:** `POST /api/login`

**Payload:**

```json
{
  "email": "admin@unisant.edu.mx",
  "password": "admin1234"
}
```

**Respuesta exitosa:**

```json
{
  "access_token": "token_jwt_aqui",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

### Probar rutas protegidas

Agrega en headers de la petición:

```
Authorization: Bearer token_jwt_aqui
```

---

### Rutas principales

| Método | Ruta               | Descripción               |
|--------|--------------------|---------------------------|
| POST   | /api/login         | Login y obtención de token|
| POST   | /api/logout        | Logout (invalidar token)  |
| GET    | /api/alumnos       | Listar todos los alumnos  |
| POST   | /api/alumnos       | Crear un alumno           |
| GET    | /api/alumnos/{id}  | Mostrar alumno por matrícula |

---

## Usuario de prueba

| Email               | Password   | Rol    |
|---------------------|------------|--------|
| admin@unisant.edu.mx | admin1234  | Admin  |

---

## Postman

Puedes importar esta colección para probar fácilmente la API:  
https://www.postman.com/speeding-meadow-318772/workspace/public/collection/21228356-87613919-571c-42c9-ac77-705c91fe7af9?action=share&creator=21228356

---

## Notas

- Todas las rutas protegidas requieren el header `Authorization` con token válido.
- Si el token es inválido o falta, la API responderá con JSON con mensaje de error y código 401.
- JWT tiene tiempo de expiración configurado (default 1 hora).

---

## Autor

LuisAlexisT - [Tu GitHub](https://github.com/LuisAlexisT)
