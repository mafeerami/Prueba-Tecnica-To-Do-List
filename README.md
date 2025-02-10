# Prueba-Tecnica-To-Do-List

## Descripción

Esta es una aplicación de lista de tareas desarrollada en Laravel. Permite a los usuarios registrar tareas, marcarlas como completadas y eliminarlas. La aplicación incluye autenticación de usuario.

## Instrucciones para Ejecutar el Proyecto Localmente

### Requisitos Previos

- PHP 7.4 o superior
- Composer
- MySQL
- Git

### Instalación

1. **Clonar el Repositorio**:
   ```bash
   git clone https://github.com/mafeerami/Prueba-Tecnica-To-Do-List.git
   cd Prueba-Tecnica-To-Do-List
2. Instalar dependencias
Comando : composer install
3. Configurar el Archivo .env:

Copia el archivo de ejemplo .env.example y renómbralo a .env
Comando: cp .env.example .env
4. Generar la Clave de la Aplicación:
Comando bash:
php artisan 
5. Ejecutar las Migraciones:
bash
php artisan migrate
6. Iniciar el Servidor de Desarrollo, esto ejecutara la app y podras visualizarla en http://localhost:8000
bash
php artisan 

Para que puedas ver, agregar,editar,completar y eleiminar una tarea debes registrarte.
