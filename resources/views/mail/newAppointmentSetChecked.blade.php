@component('mail::message')
@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/setChecked/1')])
@lang('messages.accept_kinda_appointment')
@endcomponent

<small>
@lang('messages.note_if_the_link_does_not_work_for_you_copy_and_paste_the_following_link_in_your_address_bar'): <br>
{{ URL::asset('appointment/'.$appointmentId.'/setChecked/1/true') }}
</small>

@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/setChecked/2/true')])
@lang('messages.reject_kinda_appointment')
@endcomponent

<small>
@lang('messages.note_if_the_link_does_not_work_for_you_copy_and_paste_the_following_link_in_your_address_bar'): <br>
{{ URL::asset('appointment/'.$appointmentId.'/setChecked/2') }}
</small>

@lang('messages.thank_you'),<br>
{{ config('app.name') }}
@endcomponent