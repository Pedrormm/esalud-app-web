@component('mail::message')
# Cambio de contraseña

Hola {{ $name }}, se ha solicitado un cambio de contraseña. 
Por favor, haga click en el siguiente enlace si desea cambiar su contraseña

@component('mail::button', ['url' => URL::asset('password/reset/' . $token)])
Nueva contraseña
@endcomponent


<small>
NOTA: Si el enlace no te funciona, copia y pega el sigueinte link en tu barra de navegación:<br>
{{ URL::asset('password/reset/' . $token) }}
</small>

Gracias,<br>
{{ config('app.name') }}
@endcomponent