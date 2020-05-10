<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <title>{{ env('APP_NAME') }}</title>

                <!-- Jquery & Bootstrap core JavaScript-->
                <!-- <script src="{{ asset('vendor/jquery/dist/jquery.js') }}"></script> -->
                <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

                <!-- Core plugin JavaScript-->
                <script type="text/javascript" src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

                <!-- Page level plugins -->
                <script type="text/javascript" src="{{ asset('vendor/chartjs/Chart.min.js')}}"></script>

                <!-- Datatables-->
 {{--               <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
                <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>--}}
                <!-- <script src="{{ asset('vendor/datatables/datatables-demo.js')}}"></script> -->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.js"></script>


                <!-- Modernizr-->
                <script src="{{ asset('vendor/modernizr/modernizr.custom.js')}}"></script>
                <!-- Storage API-->
                <script src="{{ asset('vendor/js-storage/js.storage.js')}}"></script>
                <!-- Screenfull-->
                <script src="{{ asset('vendor/screenfull/dist/screenfull.js')}}"></script>
                <!-- i18next-->
  {{--              <script src="{{ asset('vendor/i18next/i18next.js')}}"></script>
                <script src="{{ asset('vendor/i18next-xhr-backend/i18nextXHRBackend.js')}}"></script>--}}
{{--                <script src="{{ asset('vendor/jquery/dist/jquery.js')}}"></script>--}}
                <script src="{{ asset('vendor/popper.js/dist/umd/popper.js')}}"></script>
                <!-- <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.js')}}"></script> -->


                <!-- Page level custom scripts -->
                <!-- <script type="text/javascript" src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
                <script type="text/javascript" src="{{ asset('js/demo/chart-pie-demo.js')}}"></script> -->


                <!-- Font awesome-->
                <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

                <!-- Bootstrap styles-->
{{--                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}


                <link rel="stylesheet" href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css')}}">
                <!-- ANIMATE.CSS-->
                <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.css')}}">
                <!-- WHIRL (spinners)-->
                <link rel="stylesheet" href="{{ asset('vendor/whirl/dist/whirl.css')}}">


                <!-- =============== CUSTOM STYLES ===============-->
                <link rel="stylesheet" href="{{ asset('css/application.css')}}" id="maincss">
                <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">
                <link rel="stylesheet" href="{{ asset('css/custom-app.css')}}" id="maincss">

                <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/core.css') }}">


                <!-- =============== CUSTOM SCRIPTS ===============-->
                <script type="text/javascript" src="{{ asset('js/application.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/sb-admin-2.js')}}"></script>
                <script src="{{ asset('js/custom-app.js')}}"></script>
                {{-- bootbox --}}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

                {{-- Bootstrap select --}}
                <!-- Latest compiled and minified CSS -->
                {{-- https://developer.snapappointments.com/bootstrap-select/ --}}
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

                <!-- Latest compiled and minified JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

                <!-- (Optional) Latest compiled and minified JavaScript translation files -->
                {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> --}}

                <link rel="stylesheet" 
                href="{{ asset('modules/ajax-bootstrap-select/dist/css/ajax-bootstrap-select.min.css')}}">
                
                <script type="text/javascript" 
                src="{{ asset('modules/ajax-bootstrap-select/dist/js/ajax-bootstrap-select.min.js')}}">
                </script>



               
        <script>
                const _PUBLIC_URL = "{{ asset('') }}";
        </script>

    </head>