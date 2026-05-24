<x-mail::message>
# ¡Te han invitado a colaborar en Noteworld!

Hola. El administrador del sistema te ha otorgado acceso exclusivo para que colabores en nuestra API de World Building. 

Hemos registrado esta invitación bajo tu correo: **{{ $correoInvitado }}**

<x-mail::button :url="route('register')">
Aceptar Invitación y Registrarme
</x-mail::button>

¡Empieza a construir universos y subir imágenes con nosotros!<br>
El equipo de {{ config('app.name') }}
</x-mail::message>