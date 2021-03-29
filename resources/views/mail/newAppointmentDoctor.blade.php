@component('mail::message')
# Nueva cita médica

Hola {{ $doctorName }}, se ha creado una nueva cita médica con el médico {{ $patientName }}. 
Por favor, haga click en el siguiente enlace para ver su cita médica

{{-- @component('mail::button', ['']) --}}
@endcomponent
