@php header('Access-Control-Allow-Origin: *'); @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswat ch/4.5.2/cosmo/bootstrap.min.css"> --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

</head>

<body>

    <div class="container-fluid" >
        <div class="top">
            <div class="d-flex justify-content-center logo">
                <img src="{{ url('/images/logo.png') }}" alt=@lang('messages.logo_stat')>
            </div>
        </div>
        <div class="bottom">
        </div>
        <div class="icon-center">
            <i class="fas fa-hand-pointer fa-lg"></i>
        </div>
        <div class="center">

            <h2>@lang('messages.enter_DNI_and_password')</h2>
            {{-- <form method="post" action="{{ url('login') }}"> --}}
            {{ Form::open(array('url' => 'login', 'method' => 'POST', 'class' => 'form-horizontal')) }}

                @csrf
                <input type="text" name="dni" class="ct" placeholder="@lang('messages.DNI_or_email')" value="{{ Cookie::get('credencialesDni') }}" autocomplete="on"/>
                <input id="password-field" type="password" name="password" class="ct" placeholder="@lang('messages.password_stat')" autocomplete="on"/>
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                <div class="rememberme form-group form-check m-1">
                    <input name="remember" type="checkbox" class="form-check-input" id="rememberMe" {{ (Cookie::has('credencialesDni')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="rememberMe">@lang('messages.remember_me')</label>
                </div>
                @if (session()->has('info'))
                    <div class="alert alert-success" id="infoSession">{{ session()->get('info') }}</div>
                    {{ Session::forget('info') }}
                @endif
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            
                @if(session('successful'))
                    <div class="alert alert-success">
                        {{ session('successful') }}
                    </div>
                @endif
                <button type="submit" class="btn btn-primary btn-lg form-control form-control-lg" >@lang('messages.enter_stat')</button>
            {{-- </form> --}}
            {{ Form::close() }}

            <div class="text-center m-1">
                <a href="{{ url('isPasswordForgotten')  }}" class="remember_password" 
                data-name-role="">
                    @lang('messages.have_you_forgotten_your_password')
                </a>
            </div>
  
        </div>
    </div>

    @include('inc.modals')    

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/index-needed.functions.js') }}"></script>
@include('inc.jsGlobalsDefinition')
{{-- <script type="text/javascript" src="{{ asset('js/application.js') }}"></script> --}}

<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>

</html>
