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

</head>

<body>

    <div class="container-fluid" >
        <div class="top">
            <div class="d-flex justify-content-center logo">
                <img src="{{ url('/images/logo.png') }}" alt="Logo">
            </div>
        </div>
        <div class="bottom">
            {{-- <i class="fas fa-hand-pointer"></i> --}}
        </div>
        <div class="icon-center">
            <i class="fas    fa-hand-pointer fa-lg"></i>
        </div>
        <div class="center">

            <h2>Introduzca DNI y contraseña</h2>
            <form method="post" action="{{ url('user/login') }}">
                @csrf
                <input type="text" name="dni" class="ct" placeholder="DNI o email" value="{{ Cookie::get('credencialesDni') }}" />
                <input type="password" name="password" class="ct" placeholder="password" />
                <div class="rememberme form-group form-check m-1">
                    <input name="remember" type="checkbox" class="form-check-input" id="rememberMe" {{ (Cookie::has('credencialesDni')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="rememberMe">Recordar</label>
                </div>

                @if (session()->has('info'))
                <div class="alert alert-success">{{ session()->get('info') }}</div>
                @endif
                <div>
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

                <button type="submit" class="btn btn-primary btn-lg form-control form-control-lg" >Entrar</button>
            </form>
            <div class="text-center m-1">
                <a href="{{ URL::asset('user/remember')  }}" class="remember_password" 
                id="usersDistRole" data-name-role="">
                ¿Has olvidado tu contraseña?
                </a>
            </div>
  
        </div>
    </div>

    @include('inc.modals')    

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/application.js') }}"></script>
</html>
