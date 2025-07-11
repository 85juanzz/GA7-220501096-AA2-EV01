# 🥐 Sistema de Gestión - Panadería "El Buen Sabor"

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)

**Aprendiz:** [Tu Nombre Completo]

---

## 📝 Descripción del Proyecto

Este es un sistema web para la gestión de una panadería, desarrollado en PHP siguiendo una arquitectura modular y segura. El proyecto demuestra las competencias fundamentales del desarrollo de software, incluyendo la conexión a bases de datos, la implementación de operaciones CRUD (Crear, Leer, Actualizar, Eliminar) y la aplicación de estándares de codificación y seguridad.

## ✨ Características Principales

-   🔐 **Autenticación Segura:** Sistema de login con manejo de sesiones y contraseñas hasheadas (`password_hash`).
-   ⚙️ **Módulo CRUD completo:** Gestión de Empleados con operaciones para Crear, Leer, Actualizar y Eliminar registros.
-   🛡️ **Control de Acceso por Roles:** Vistas y acciones restringidas para que solo los usuarios con el rol "Administrador" puedan acceder al módulo de empleados.
-   🔒 **Prevención de Inyección SQL:** Uso estricto de **sentencias preparadas** (`prepare`, `bind_param`) en todas las consultas a la base de datos.
-   📱 **Interfaz Responsiva:** Diseño adaptable a diferentes tamaños de pantalla (móvil, tablet, escritorio) gracias al uso del framework Bootstrap 5.

## 🚀 Cómo Ejecutar el Proyecto

Sigue estos pasos para instalar y ejecutar el proyecto en un entorno local.

### Prerrequisitos

-   Un entorno de servidor local como **XAMPP**, **WAMP** o **MAMP** que incluya:
    -   Apache
    -   PHP 8 o superior
    -   MySQL / MariaDB

### Pasos de Instalación

1.  **Descargar el Proyecto:**
    Clona o descarga este repositorio en la carpeta `htdocs` (para XAMPP) o `www` (para WAMP) de tu servidor local.

2.  **Base de Datos:**
    -   Abre `phpMyAdmin` desde el panel de control de tu servidor local.
    -   Crea una nueva base de datos llamada `panaderia_db`.
    -   Selecciona la base de datos `panaderia_db` y ve a la pestaña "Importar".
    -   Importa el archivo `panaderia_db.sql` que se encuentra en la raíz de este proyecto. (***Nota:*** *Deberás crear este archivo exportando la estructura y los datos de tu base de datos*).

3.  **Configuración:**
    El archivo de conexión `/config/database.php` está preconfigurado para un entorno local estándar (usuario `root` sin contraseña). Si tu configuración es diferente, ajústala en este archivo.

4.  **Ejecutar:**
    -   Asegúrate de que los servicios de Apache y MySQL estén corriendo.
    -   Abre tu navegador y ve a `http://localhost/Panaderia_Proyecto_PHP/` (o el nombre que le hayas dado a la carpeta del proyecto).

### Credenciales de Acceso

Para probar la funcionalidad de administrador, utiliza las siguientes credenciales:

-   **Usuario:** `admin`
-   **Contraseña:** `admin123`

*(Asegúrate de que este usuario exista en tu base de datos con el rol 'Administrador').*

---

## 📋 Cumplimiento de la Evidencia GA7-220501096-AA2-EV01

> **Nota sobre la tecnología:** Aunque la evidencia sugiere Java/JDBC, este proyecto cumple con todos los requerimientos conceptuales y funcionales utilizando el stack PHP/MySQL, un estándar robusto y ampliamente utilizado en la industria del desarrollo web.

A continuación se detalla cómo el proyecto aborda cada punto:

### 1. Conexión con Bases de Datos
-   **Archivo:** ``/config/database.php``
-   **Descripción:** Este script centraliza la conexión con MySQL usando el conector `mysqli`. Implementa manejo de errores y configuración de charset, siendo el equivalente funcional a una clase de conexión en otros lenguajes.

### 2. Funcionalidades CRUD
-   **Módulo de Ejemplo:** ``/modulos/empleados/``
-   **Descripción:** Este módulo es la demostración completa de las cuatro operaciones de base de datos.
    -   **CREATE (Crear):** `crear.php` (formulario) y `guardar.php` (lógica de inserción segura).
    -   **READ (Leer):** `index.php` (consulta y muestra de una lista de empleados).
    -   **UPDATE (Actualizar):** `editar.php` (formulario con datos precargados) y `actualizar.php` (lógica de actualización).
    -   **DELETE (Eliminar):** `eliminar.php` (lógica de borrado con validaciones de seguridad).

### 3. Estándares de Codificación y Estructura
-   **Nomenclatura:** Se utiliza un estilo de nombrado consistente en todo el proyecto.
-   **Estructura de "Paquetes":** El proyecto está organizado en directorios que separan responsabilidades (`config`, `modulos`, `templates`), promoviendo un código limpio y mantenible.
-   **Seguridad:** Como se mencionó, el proyecto implementa hasheo de contraseñas y sentencias preparadas para garantizar la seguridad de los datos.

### 4. Uso de Versionamiento
-   **Repositorio:** El código fuente está gestionado en un repositorio Git. El enlace se puede encontrar en el archivo `repositorio.txt`.
