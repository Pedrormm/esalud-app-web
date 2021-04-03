@component('mail::message')
# Mensaje de bienvenida

Hola {{ $name." ".$lastname }} , <br/>
Te damos la bienvenida a {{ config('app.name') }}!
Una nueva cuenta ha sido creada con el dni {{ $dni }} desde la IP pública {{ $publicIp }}

Para acceder a la aplicación haga click en el siguiente enlace:
@component('mail::button', ['url' => Auth::user() ? URL::asset('logout/') : URL::asset('/')])
Acceso al login
@endcomponent

<small>
NOTA: Si el enlace no te funciona, copia y pega el sigueinte link en tu barra de navegación:<br>
@if (Auth::user())
    {{ URL::asset('logout/') }}
@else
    {{ URL::asset('/') }}
@endif
</small>

Gracias por confiar en nosotros,<br/>
{{ config('app.name') }}
@endcomponent
