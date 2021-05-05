@component('mail::message')
# Nueva cita médica

Hola {{ $patientName }}, se ha creado una nueva cita médica con el médico {{ $doctorName }}. 
Por favor, haga click en el siguiente enlace para ver o editar su cita médica
    
@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/edit')])
Ver o editar cita
@endcomponent

<small>
NOTA: Si el enlace no te funciona, copia y pega el sigueinte link en tu barra de navegación:<br>
{{ URL::asset('appointment/'.$appointmentId.'/edit') }}
</small>

@if (($isPatient) && ($appointmentUserCreatorRole != \HV_ROLES::PATIENT))
{{-- Es paciente --}}
@include('mail.newAppointmentSetChecked', ['appointmentId' => $appointmentId])

@elseif ((!$isPatient) && ($appointmentUserCreatorRole != \HV_ROLES::DOCTOR))
    {{-- No Es paciente --}}

    @include('mail.newAppointmentSetChecked', ['appointmentId' => $appointmentId])

@else
    Es otro rol
@endif

@endcomponent
