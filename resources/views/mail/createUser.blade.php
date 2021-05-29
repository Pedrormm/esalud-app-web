@component('mail::message')
# @lang('messages.New user')

@lang('messages.Hello, a new user admission has been requested to this email with the DNI(id) ') {{ $dni }}

@lang('messages.Click to register in the application'){{ config('app.name') }}:
@component('mail::button', ['url' => URL::asset('user/createUserFromMail/' . $token)])
@lang('messages.New user')
@endcomponent

<small>
@lang('messages.NOTE: If the link does not work for you, copy and paste the following link in your address bar')<br>
{{ URL::asset('user/createUserFromMail/' . $token) }}
</small>

@lang('messages.Thank you'),<br>
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