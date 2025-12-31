# HIPASUR - Sistema de Gestión Minera

**Hipasur** es una plataforma integral desarrollada en Laravel para la gestión y administración de operaciones mineras. El sistema permite controlar eficientemente los recursos humanos, la producción, la logística y las finanzas de la empresa.

## Características Principales

El sistema cuenta con un panel administrativo robusto y gestión de roles (Administrador, Secretaria, Encargado, Personal) para controlar el acceso a los diferentes módulos:

### Gestión Administrativa
*   **Usuarios:** Administración completa de cuentas de usuario y roles.
*   **Recursos Humanos:** Gestión de personal, contratos y asistencia.
*   **Secretaría:** Módulo dedicado para labores administrativas.
*   **Proveedores:** Registro y gestión de proveedores de la empresa.

### Operaciones Mineras
*   **Producción:** Registro y seguimiento de la producción minera diaria.
*   **Movimientos:** Control de movimientos de material y recursos.
*   **Fiscalización:** Herramientas para el control y fiscalización de actividades.

### Logística y Activos
*   **Vehículos y Maquinaria:** Inventario y control de flota.
*   **Almacén:** Gestión de inventario de almacén.

### Finanzas
*   **Pagos:** Gestión de pagos y transacciones.
*   **Reportes PDF:** Generación de comprobantes y reportes.

### Seguridad
*   **Seguridad y Salud:** Módulo para el cumplimiento de normativas de seguridad y salud ocupacional (SSO).

---

## Stack Tecnológico

*   **Backend:** [Laravel 12.x](https://laravel.com) (PHP 8.2+)
*   **Frontend:** [Bootstrap 5](https://getbootstrap.com/), Blade Templates
*   **Build Tool:** [Vite](https://vitejs.dev)
*   **Base de Datos:** MySQL / MariaDB

---

## Instalación y Configuración

Sigue estos pasos para levantar el proyecto en tu entorno local:

1.  **Clonar el repositorio**
    ```bash
    git clone <https://github.com/Nayi-menis/HIPASUR.git>
    cd hipasur
    ```

2.  **Instalar dependencias de PHP**
    ```bash
    composer install
    ```

3.  **Instalar dependencias de Frontend**
    ```bash
    npm install
    ```

4.  **Configurar variables de entorno**
    Copia el archivo de ejemplo `.env.example` a `.env` y configura tu conexión a base de datos:
    ```bash
    cp .env.example .env
    # Edita DB_DATABASE, DB_USERNAME, DB_PASSWORD en el archivo .env
    ```

5.  **Generar clave de aplicación**
    ```bash
    php artisan key:generate
    ```

6.  **Migrar y sembrar la base de datos**
    Este comando creará las tablas e insertará los usuarios por defecto.
    ```bash
    php artisan migrate --seed
    ```

7.  **Compilar assets e iniciar servidor**
    ```bash
    npm run dev
    php artisan serve
    ```

---

## Credenciales de Acceso (Entorno Local)

El sistema viene precargado con los siguientes usuarios para pruebas (definidos en `DatabaseSeeder.php`):

| Rol | Correo Electrónico | Contraseña |
| :--- | :--- | :--- |
| **Administrador** | `administrador@gmail.com` | `12345678` |
| **Secretaria** | `secretaria@gmail.com` | `12345678` |
| **Trabajador** | `personal@gmail.com` | `12345678` |
| **Encargado** | `encargado@gmail.com` | `12345678` |
| 

> [!WARNING]
> Estas credenciales son solo para entornos de desarrollo. Asegúrate de cambiarlas en producción.

---

##  Licencia

Este proyecto es software propietario. Todos los derechos reservados.
