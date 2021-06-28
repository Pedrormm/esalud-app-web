<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ env('APP_NAME') }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

        <!-- Latest compiled and minified bootstrap CSS -->
        <!-- https://getbootstrap.com/ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- Font awesome-->
        <!-- https://fontawesome.com/ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

        <!-- Google fonts -->
        <!-- https://fonts.google.com/ -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Lato:wght@300&family=News+Cycle:wght@700&display=swap" rel="stylesheet">

        <!-- Latest compiled and minified Bootstrap select (selectpicker) CSS -->
        <!-- https://developer.snapappointments.com/bootstrap-select/ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


        <!-- =============== CUSTOM STYLES ===============-->
        <link rel="stylesheet" href="{{ asset('css/media-table.css')}}" id="mediaTableCss">
        <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/custom-app.css')}}" id="customAppCss">
        <link rel="stylesheet" href="{{ asset('css/application.css')}}" id="maincss">

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/core.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/structure.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-theme.css') }}">
        

</head>