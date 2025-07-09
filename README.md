# Moondrive - Plataforma de Alquiler de Vehículos

Moondrive es una aplicación web completa desarrollada con Laravel que facilita el alquiler de vehículos. La plataforma conecta a propietarios de coches con clientes que buscan alquilar, e incluye un panel de administración para gestionar las operaciones.

## ✨ Funcionalidades Principales

- **Registro y Autenticación de Usuarios**: Roles diferenciados para Clientes, Propietarios y Administradores.
- **Flujo de Propietarios**:
  - Registro de vehículos con detalles completos (marca, modelo, año, fotos, precio).
  - Panel de control con estadísticas de ingresos, vehículos y reservas.
  - Gestión de solicitudes de reserva (aprobar y rechazar).
- **Flujo de Clientes**:
  - Búsqueda y filtrado avanzado de vehículos (por precio, año, tipo, etc.).
  - Vista de detalles del vehículo.
  - Proceso de reserva con selección de fechas y horas.
- **Panel de Administración**:
  - Panel central para supervisar las solicitudes de registro de nuevos vehículos.
  - Funcionalidad para aprobar o rechazar los vehículos enviados por los propietarios.
  - Estadísticas clave de la plataforma.

## 🚀 Requisitos del Sistema

- PHP >= 8.2
- Composer 2.x
- Node.js >= 18.x
- npm (generalmente se instala con Node.js)
- Una base de datos (ej. MySQL, MariaDB, PostgreSQL).

## 🛠️ Instrucciones de Instalación

Sigue estos pasos para poner en marcha el proyecto en tu entorno de desarrollo local.

### 1. Clonar el Repositorio
```bash
git clone https://github.com/zair-l/Moondrive.git
cd Moondrive
```

### 2. Configuración del Backend (Laravel)

```bash
# Instalar dependencias de PHP
composer install

# Copiar el archivo de entorno
cp .env.example .env

# Generar la clave de la aplicación
php artisan key:generate

# Configurar la base de datos
# Abre el archivo .env y configura las variables de la base de datos (DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.).

# Ejecutar las migraciones para crear las tablas
php artisan migrate

# Ejecutar los seeders para poblar la base de datos con datos iniciales (incluido el usuario administrador)
php artisan db:seed
```

### 3. Configuración del Frontend (Vite)

```bash
# Instalar dependencias de Node.js
npm install
```

## ධ Ejecutar la Aplicación

Para iniciar el proyecto, necesitarás ejecutar tanto el servidor de desarrollo de Laravel como el de Vite para el frontend.

1.  **Terminal 1: Iniciar el servidor de Laravel**
    ```bash
    php artisan serve
    ```

2.  **Terminal 2: Compilar los assets del frontend**
    ```bash
    npm run dev
    ```

Una vez que ambos procesos estén en marcha, podrás acceder a la aplicación en la URL que indique `php artisan serve` (generalmente `http://127.0.0.1:8000`).

---
¡Y eso es todo! Con estos pasos, tendrás una copia funcional de Moondrive corriendo en tu máquina local.
