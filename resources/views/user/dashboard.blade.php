@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on" data-item="1">Portada</div>
        <div class="div_2" data-item="2">Noticias</div>
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
                //document.getElementById("news-container").style.display = "none";
                // En jQuer: $('#news-container').hide(); //Mucho mas fácil. Lo se, no lo hacia 
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