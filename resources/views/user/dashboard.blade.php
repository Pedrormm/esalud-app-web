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
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <canvas id="usersChart"></canvas>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-3">
      
      @if((isset($successful)) || (session()->has('info'))
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
 

            // $('#home-tab').click(function(e){
            //     // asyncCall('messaging/getMessages', '#main-container', true);
            //     asyncCall(PublicURL+'user/index', '#main-container', true);

            // });

            // $('#news-tab').click(function(e){
            //     asyncCall('dashboard/news', '#main-container', true);
            // });




    </script>
@endsection

@section('scriptsPropios')
  <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection