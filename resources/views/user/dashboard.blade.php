@extends('layout.logged')

@section('nav-bar-top')

<nav class="top">
    <ul class="nav nav-pills nav-fill">
    <div class="div_2 on">
        <li class="nav-item">
            <a class="nav-link active">Portada</a>
        </li>
    </div>
    <div class="div_2">
        <li class="nav-item">
            <a class="nav-link">Noticias</a>
        </li>
    </div>
    </ul>
</nav>

@endsection

@section('content')


    <div id="main-container" class="container-fluid">
    </div>

    <div id="news-container" class="container-fluid">
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
                //document.getElementById("main-container").style.display = "none";
                asyncCall('user/news', '#main-container', true);
            }
        });
        asyncCall('user/messages', '#main-container', true);
    </script>
@endsection