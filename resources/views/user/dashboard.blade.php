@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on" data-item="1">Portada</div>
        <div class="div_2" data-item="2">Noticias</div>
    </nav>
@endsection

@section('content')

    Welcome user! Congratulations to pedro!
    <div id="main-container" class="container-fluid">

    <div>
        @foreach ($news as $piecenew)
        <div class="box">
            <h4>{{ $piecenew->title }}</h4>
            <p>{{ $piecenew->content }}</p>
            <h6 style="text-align: right">{{ $piecenew->date }}</h6>
        </div>
        @endforeach
    </div>
    <script>
        $('nav .div_2').click(function(e) {
            let item = $(this).data('item');
            $('nav .div_2').removeClass('on');
            $('nav .div_2').eq(item-1).addClass('on');
            if(item == 1) {
                asyncCall('user/messages', '#main-container', true);
            }
            else {
                asyncCall('user/news', '#main-container', true);
            }
        });
        asyncCall('user/messages', '#main-container', true);
    </script>
@endsection