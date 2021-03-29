@component('mail::message')
# Nueva cita médica

Hola {{ $patientName }}, se ha creado una nueva cita médica con el médico {{ $doctorName }}. 
Por favor, haga click en el siguiente enlace para ver su cita médica

{{-- @component('mail::button', ['']) --}}
@endcomponent

