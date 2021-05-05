@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/setChecked/1')])
Aceptar cita
@endcomponent

<small>
NOTA: Si el enlace no te funciona, copia y pega el sigueinte link en tu barra de navegación:<br>
{{ URL::asset('appointment/'.$appointmentId.'/setChecked/1/true') }}
</small>

@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/setChecked/2/true')])
Rechazar cita
@endcomponent

<small>
NOTA: Si el enlace no te funciona, copia y pega el sigueinte link en tu barra de navegación:<br>
{{ URL::asset('appointment/'.$appointmentId.'/setChecked/2') }}
</small>
