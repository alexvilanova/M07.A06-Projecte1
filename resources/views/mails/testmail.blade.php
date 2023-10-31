<x-mail::message>
Bienvenido a nuestra Red Social

<x-mail::button :url="'http://127.0.0.1:8000/dashboard'">
Iniciar sesión
</x-mail::button>

Gracias por unirte a nosotros,<br>
{{ config('app.name') }}
</x-mail::message>
