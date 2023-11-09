# Proyecto Laravel M07.A06

## Requisitos Previos

Para comenzar con el desarrollo en este proyecto, asegúrate de tener instalados los siguientes requisitos:

- **PHP:** Versión 7.4 o superior.
- **Composer:** Herramienta de gestión de dependencias para PHP.
- **Node.js y NPM:** Utilizados para gestionar activos y dependencias frontales.

## Configuración del Proyecto

1. **Clonar el Repositorio:**

    ```bash
    git clone https://github.com/alexvilanova/M07.A06-Projecte1.git
    ```

2. **Instalar Dependencias:**

    ```bash
    cd M07.A06-Projecte1
    composer install
    ```

3. **Copiar el Archivo de Configuración:**

    ```bash
    cp .env.example .env
    ```

    Después, edita el archivo `.env` con la configuración de tu base de datos y otros ajustes necesarios.

4. **Generar la Clave de Aplicación:**

    ```bash
    php artisan key:generate
    ```

5. **Ejecutar Migraciones:**

    ```bash
    php artisan migrate --seed
    ```

    Esto creará la estructura de base de datos necesaria.

6. **Instala NPM:**

    ```bash
    npm install
    ```

7. **Crea el enlace simbólico a storage:**

    ```bash
    php artisan storage:link
    ```

## Ejecutar Proyecto

1. **Ejecutar el Motor Gráfico:**
    ```bash
    npm run dev
    ```

2. **Ejecutar el Back-end de laravel:**

    ```bash
    php artisan serve
    ```

---

