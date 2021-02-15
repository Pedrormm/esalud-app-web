@extends('layout.logged')

@section('nav-bar-top')

<!-- <nav class="top"> -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Portada</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="profile" aria-selected="false">Noticias</a>
  </li>
</ul>
<!-- <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"></div>
  <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab"></div>
</div> -->


@endsection

@section('content')


    <div id="main-container" class="container-fluid">
  
    </div>

    <div class="container-fluid mt-3">
      
      @if(isset($successful))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-info">
              {{ $successful }}     
            </div>
          </div>
        </div>
      @endif

  </div>


    <script>
        /*
        $('nav .div_2').click(function(e) {
            let item = $(this).data('item');
            $('nav .div_2').removeClass('on');
            $('nav .div_2').eq(item-1).addClass('on');
            if(item == 1) {            
                asyncCall('user/messages', '#main-container', true);
            }
            else {
                //document.getElementById("main-container").style.display = "none";
            asyncCall('user/messages', '#main-container', true);
            }
        });
        asyncCall('user/messages', '#home', true);
*/

        // @if(session('successful'))
        //   <div class="alert alert-success">
        //       {{ session('successful') }}
        //   </div>
        // @endif

            $('#home-tab').click(function(e){
                // asyncCall('user/messages', '#main-container', true);
                asyncCall(PublicURL+'user/index', '#main-container', true);

            });

            $('#news-tab').click(function(e){
                asyncCall('user/news', '#main-container', true);
            });
            // asyncCall(PublicURL+'user/index', '#main-container', true);
            // asyncCall('user/messages', '#main-container', true);




    </script>
@endsection