@component('mail::message')
# @lang('messages.new_user')

@lang('messages.hello_a_new_user_admission_has_been_requested_to_this_email_with_the_DNI')  {{ $dni }}

@lang('messages.click_to_register_in_the_application') {{ config('app.name') }}:
@component('mail::button', ['url' => URL::asset('user/createUserFromMail/' . $token)])
@lang('messages.new_user')
@endcomponent

<small>
@lang('messages.note_if_the_link_does_not_work_for_you_copy_and_paste_the_following_link_in_your_address_bar'): <br>
{{ URL::asset('user/createUserFromMail/' . $token) }}
</small>

@lang('messages.thank_you'),<br>
{{ config('app.name') }}
@endcomponent
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Crear usuario</title>
</head>
<body>
    <h1>Hola, se ha solicitado un nuevo usuario a este email con el dni {{ $dni }}</h1>
    <p> Haga click para registrarse en la aplicación: </p>
    <a class="btn btn-primary" href="{{ URL::asset('user/createUserFromMail/' . $token)}}" role="button">Nuevo usuario</a>
    
</body>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


</html> --}}