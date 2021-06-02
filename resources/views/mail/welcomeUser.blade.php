@component('mail::message')
# @lang('messages.welcome_message')

@lang('messages.hello_data') {{ $name." ".$lastname }} , <br/>
@lang('messages.we_would_like_to_welcome_you_to') {{ config('app.name') }}!
@lang('messages.a_new_user_has_been_created_with_the_DNI')  {{ $dni }}  @lang('messages.from_within_the_public_IP') {{ $publicIp }}

@lang('messages.should_you_want_to_access_the_application_click_on_the_following_link'):
@component('mail::button', ['url' => Auth::user() ? URL::asset('logout/') : URL::asset('/')])
@lang('messages.login_access')
@endcomponent

<small>
@lang('messages.note_if_the_link_does_not_work_for_you_copy_and_paste_the_following_link_in_your_address_bar:')<br>
@if (Auth::user())
    {{ URL::asset('logout/') }}
@else
    {{ URL::asset('/') }}
@endif
</small>

@lang('messages.thank_you_for_trusting_us'),<br>
{{ config('app.name') }}
@endcomponent
