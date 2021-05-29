@component('mail::message')
@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/setChecked/1')])
@lang('messages.accept appointment')
@endcomponent

<small>
@lang('messages.NOTE: If the link does not work for you, copy and paste the following link in your address bar')<br>
{{ URL::asset('appointment/'.$appointmentId.'/setChecked/1/true') }}
</small>

@component('mail::button', ['url' => URL::asset('appointment/'.$appointmentId.'/setChecked/2/true')])
@lang('messages.reject appointment')
@endcomponent

<small>
@lang('messages.NOTE: If the link does not work for you, copy and paste the following link in your address bar')<br>
{{ URL::asset('appointment/'.$appointmentId.'/setChecked/2') }}
</small>

@lang('messages.Thank you'),<br>
{{ config('app.name') }}
@endcomponent