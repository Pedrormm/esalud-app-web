@component('mail::message')
# @lang('messages.Password change')

@lang('messages.Hello') {{ $name }}, @lang('messages.a password change has been requested')
@lang('messages.Please click on the following link if you want to change your password')

@component('mail::button', ['url' => URL::asset('password/reset/' . $token)])
@lang('messages.Create new password')
@endcomponent

<small>
@lang('messages.NOTE: If the link does not work for you, copy and paste the following link in your address bar')<br>
{{ URL::asset('password/reset/' . $token) }}
</small>

@lang('messages.Thank you'),<br>
{{ config('app.name') }}
@endcomponent