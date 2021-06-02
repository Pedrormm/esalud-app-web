@component('mail::message')
# @lang('messages.password_change')

@lang('messages.hello_data') {{ $name }}, @lang('messages.a_password_change_has_been_requested')
@lang('messages.please_click_on_the_following_link_if_you_want_to_change_your_password')

@component('mail::button', ['url' => URL::asset('password/reset/' . $token)])
@lang('messages.create_new_password')
@endcomponent

<small>
@lang('messages.note_if_the_link_does_not_work_for_you_copy_and_paste_the_following_link_in_your_address_bar'): <br>
{{ URL::asset('password/reset/' . $token) }}
</small>

@lang('messages.thank_you'),<br>
{{ config('app.name') }}
@endcomponent