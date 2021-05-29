@component('mail::message')
# @lang('messages.New appointment')

@lang('messages.Hello') {{ $doctorName }}@lang('messages.a new appointment has been created with the patient'){{ $patientName }}. 
@lang('messages.Please click on the following link to view or edit your medical appointment')
    
@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/edit')])
@lang('messages.View or edit appointment')
@endcomponent

<small>
@lang('messages.NOTE: If the link does not work for you, copy and paste the following link in your address bar')<br>
{{ URL::asset('appointment/'.$appointmentId.'/edit') }}
</small>

@if (($isPatient) && ($appointmentUserCreatorRole != \HV_ROLES::PATIENT))
{{-- Es paciente --}}
@include('mail.newAppointmentSetChecked', ['appointmentId' => $appointmentId])

@elseif ((!$isPatient) && ($appointmentUserCreatorRole != \HV_ROLES::DOCTOR))
    {{-- No Es paciente --}}
    
    @include('mail.newAppointmentSetChecked', ['appointmentId' => $appointmentId])

@else
    {{-- Es otro rol --}}
@endif
@lang('messages.Thank you'),<br>
{{ config('app.name') }}
@endcomponent
