# Noteworld: Libreta de World Building
Este proyecto es una plataforma digital diseñada para la gestión de universos narrativos, permitiendo a los usuarios crear mundos, detallar personajes y redactar entradas de lore (historias/entradas) para sus proyectos de escritura, videojuegos o cómics.

🚀 Características principales
Gestión de Mundos: CRUD funcional para organizar universos.

Gestión de Personajes: Fichas detalladas con atributos específicos.

Gestión de Lore: Entradas organizadas por categorías.

Moodboards Colaborativos: Sistema de subida de imágenes con aprobación por parte del administrador.

API RESTful: Endpoints protegidos para la gestión de recursos de imágenes mediante Laravel Sanctum.

Reportes PDF: Generación dinámica de "Biblias del Mundo" en formato PDF.

Sistema de Roles: Dashboards diferenciados para Administradores y Escritores.

Integración de IA: Funcionalidad de autocompletado inteligente para el lore.

Documentación: Postman Collection incluida en el repositorio.

Instrucciones de instalación
Para ejecutar el proyecto en su máquina local, siga estos pasos:

Clonar el repositorio:

Bash


git clone https://github.com/marta514/Noteworld.git
cd Noteworld
Instalar dependencias de PHP:

Bash


composer install
Configurar entorno:
Cree su archivo .env a partir del ejemplo:

Bash


cp .env.example .env
Genere la clave de la aplicación:

Bash


php artisan key:generate
Configurar base de datos y Storage:

Bash


touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
Instalar y compilar recursos de frontend:

Bash


npm install
npm run build
npm run dev

Iniciar el proyecto:

Bash


php artisan serve
🔐 Credenciales de prueba
Admin: Puede crear un usuario y subirle el rol a admin mediante php artisan tinker.

Escritor: Usuario registrado con rol por defecto.

📝 Notas técnicas
El sistema utiliza Laravel Sanctum para la autenticación de la API. Se recomienda importar la colección de Postman incluida en el repositorio para probar los endpoints.

El sistema de correos está configurado para trabajar con Mailtrap.

Se ha implementado un sistema de Queues para el procesamiento de correos. Asegúrese de ejecutar php artisan queue:work para procesar los envíos en segundo plano.
