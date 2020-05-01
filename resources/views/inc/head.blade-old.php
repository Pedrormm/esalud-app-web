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

        <title>Hospital VIHrtual</title>

                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/core.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/structure.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flip.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/chat.css') }}">
                <!-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/videoconference.css') }}"> -->
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/owl/owl.carousel.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/owl/owl.theme.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/owl/owl.transitions.css') }}">
               
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-theme.css') }}">
                
                <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
               
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
                <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
                {{--
                <script type="text/javascript" src="{{ asset('js/SIPml-api.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/core.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/util.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/server.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/navigator.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/popup.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/searcher.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/call.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/sip.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/summary/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/calendar/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/chat/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/chat/chat.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/room/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/room/default2.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/permissions/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/users/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/staff/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/patients/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/medicine/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/records/default.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/records/default2.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/owl/owl.carousel.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/datepicker/bootstrap-datepicker.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/CLNDR/moment-2.5.1.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/CLNDR/underscore.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/CLNDR/clndr.js') }}"></script>--}}

                <!-- _User.id     = 1;
                _User.name   = 'Denis Vaillo Sanchez';
                _User.avatar = 'http://localhost/denis/resources/images/avatars/admin.png';
                _User._sip   = {
                        id   : "sip:denispfg@sip2sip.info",
                        name : "denispfg",
                        pass : "250707s2s",
                        url  : 'sip2sip.info'
                };
                var base_url = 'http://localhost/denis/';
            </script> -->
        <script>
        const _PUBLIC_URL = "{{ asset('') }}";
        </script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">

    </head>