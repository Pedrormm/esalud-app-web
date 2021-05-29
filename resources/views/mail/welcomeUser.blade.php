@component('mail::message')
# @lang('messages.Welcome message')

@lang('messages.Hello') {{ $name." ".$lastname }} , <br/>
@lang('messages.We would like to welcome you to') {{ config('app.name') }}!
@lang('messages.A new user has been created with the dni') {{ $dni }} @lang('messages.from witihin the public IP') {{ $publicIp }}

@lang('messages.Should you want to access the application click on the following link'):
@component('mail::button', ['url' => Auth::user() ? URL::asset('logout/') : URL::asset('/')])
@lang('messages.Login access')
@endcomponent

<small>
@lang('messages.NOTE: If the link does not work for you, copy and paste the following link in your address bar:')<br>
@if (Auth::user())
    {{ URL::asset('logout/') }}
@else
    {{ URL::asset('/') }}
@endif
</small>

@lang('messages.Thank you for trusting us'),<br>
{{ config('app.name') }}
@endcomponent
