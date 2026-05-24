<x-mail::message>
# ¡Has sido invitado a Noteworld!

El administrador te ha invitado a subir imágenes a nuestra API para enriquecer los Moodboards de la comunidad.

<x-mail::button :url="$urlSegura" color="success">
Aceptar Invitación y Subir Imagen
</x-mail::button>

Gracias,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>