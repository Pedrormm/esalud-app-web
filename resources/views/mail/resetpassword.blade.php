
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

<!--        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/splash/splash-icon.png">-->
<!--        <link rel="apple-touch-startup-image" href="images/splash/splash-screen.png" 			media="screen and (max-device-width: 320px)" />-->
<!--        <link rel="apple-touch-startup-image" href="images/splash/splash-screen@2x.png" 		media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" />-->
<!--        <link rel="apple-touch-startup-image" sizes="640x1096" href="images/splash/splash-screen@3x.png" />-->
<!--        <link rel="apple-touch-startup-image" sizes="1024x748" href="images/splash/splash-screen-ipad-landscape" media="screen and (min-device-width : 481px) and (max-device-width : 1024px) and (orientation : landscape)" />-->
<!--        <link rel="apple-touch-startup-image" sizes="768x1004" href="images/splash/splash-screen-ipad-portrait.png" media="screen and (min-device-width : 481px) and (max-device-width : 1024px) and (orientation : portrait)" />-->
<!--        <link rel="apple-touch-startup-image" sizes="1536x2008" href="images/splash/splash-screen-ipad-portrait-retina.png"   media="(device-width: 768px)	and (orientation: portrait)	and (-webkit-device-pixel-ratio: 2)"/>-->
<!--        <link rel="apple-touch-startup-image" sizes="1496x2048" href="images/splash/splash-screen-ipad-landscape-retina.png"   media="(device-width: 768px)	and (orientation: landscape)	and (-webkit-device-pixel-ratio: 2)"/>-->

        <title>{{ env('APP_VIRTUAL') }}</title>
            <!-- <link href="{{ url('css/core.css') }}" rel="stylesheet" type="text/css"> -->
            <link href="{{ url('css/userlogin.css') }}" rel="stylesheet" type="text/css">

            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/core.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/structure.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flip.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/chat.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/videoconference.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/owl/owl.carousel.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/owl/owl.theme.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/owl/owl.transitions.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-theme.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datepicker/datepicker.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/fontawesome/css/font-awesome.min.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/chat/chat.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/calendar/default.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/records/default.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/CLNDR/clndr.css') }}">

            <script type="text/javascript" src="{{ asset('js/jquery/jquery-2.1.0.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/jquery/jquery.touchSwipe.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/jquery/jquery.tmpl.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/jquery/jquery.json-2.4.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/jquery/jquery.event.move.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/application.js') }}"></script>

            <script type="text/javascript" src="{{ asset('js/SIPml-api.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/core.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/util.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/server.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>

        <script>
        const _PUBLIC_URL = "{{ asset('') }}";
        </script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">

    </head>
    <body>
        <audio id="audio_remote" autoplay="autoplay"></audio>
        <audio id="sip_ringtone" loop src="{{ asset('sounds/ringtone.wav') }}"></audio>
        <audio id="sip_ringbacktone" loop src="{{ asset('sounds/ringbacktone.wav') }}"></audio>
<header>
    <h4>{{ env('APP_VIRTUAL') }}</h4>
</header>

<main class="login">
    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="col-xs-12">
            <div class="box login_logo">
                <h3>Reseteo de contraseña</h3>
            </div>
        </div>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="box access_login">
            <h3>Reseteo de contraseña</h3>
            <form method="post" action="{{URL::asset('/passwordChanged')}}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <label>Introduzca la nueva contraseña:
                    <input type="password" name="password" placeholder="Contraseña" id="password"/>
                </label>
                <label>Repita la nueva contraseña:
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Contraseña"/>
                <span id='message'></span><br/>
                <span id='messageLength'></span>
                </label>
                <button type="submit" class="button green" type="submit">Guardar</button>
            </form>
        </div>
        </div>
    </div>
</main>

<div id="debug" style="display:none"></div>

<script>

    $('#password, #password_confirmation').on('keyup', function () {
    if ($('#password').val() == $('#password_confirmation').val()) {
        $('#message').html('Las contraseñas coinciden').css('color', 'green');
        if ($('#password').val().length < 6) {
            $('#messageLength').html('La contraseña debe tener al menos 6 caracteres').css('color', 'blue');
        }
    } else 
        $('#message').html('Las contraseñas no coinciden').css('color', 'red');
    });

</script>

</body>

</html>