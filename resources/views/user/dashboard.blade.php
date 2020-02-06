@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Portada</div>
        <div class="div_2">Noticias</div>
    </nav>
@endsection

@section('content')

    Welcome user! Congratulations to pedro!
    <div id="messages-container" class="container-fluid">

    </div>
    <script>
    asyncCall('user/messages', '#messages-container');
    </script>
@endsection