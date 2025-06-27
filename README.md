# 🧩 Laravel API con Sanctum

Este proyecto es una API base construida en **Laravel** con autenticación usando **Sanctum**. Perfecto para iniciar un backend seguro y modular. Incluye migraciones, seeders y un usuario administrador listo para pruebas.

---

## 🚀 Instalación

Sigue los pasos a continuación para correr el proyecto localmente:

```bash
# Clona el repositorio
git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo

# Copia el archivo de entorno
cp .env.example .env

# Instala dependencias
composer install

# Genera la clave de la app
php artisan key:generate

# Ejecuta las migraciones
php artisan migrate

# Llena la base de datos con datos de prueba
php artisan db:seed

# Levanta el servidor en el puerto 8000
php artisan serve --port=8000

