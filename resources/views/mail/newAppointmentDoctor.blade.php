@component('mail::message')
# @lang('messages.new_appointment')

@lang('messages.hello_data') {{ $patientName }}, @lang('messages.a_new_appointment_has_been_created_with_the_doctor') {{ $doctorName }}. 
@lang('messages.please_click_on_the_following_link_to_view_or_edit_your_medical_appointment')
    
@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/edit')])
@lang('messages.view_or_edit_appointment')
@endcomponent

<small>
@lang('messages.note_if_the_link_does_not_work_for_you_copy_and_paste_the_following_link_in_your_address_bar'): <br>
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

@lang('messages.thank_you'),<br>
{{ config('app.name') }}
@endcomponent
