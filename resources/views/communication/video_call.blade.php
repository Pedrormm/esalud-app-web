@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
    
    <div class="card shadow mb-4" id="mainCardShadow">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">Videollamada!</h4>
      </div>
      <div class="card-body" id="mainCardBody">
        <div id="app">
          
        </div>
        
        <div id="videoConf">
          
        </div>
      </div>

  </div>
  <!-- /.container-fluid -->
  
</div>
   
    
@endsection

@section('viewsScripts')
  @if (auth()->user())
    <script>
      window.user = {
        id: {{ (auth()->user()->id) }},
        dni: "{{ (auth()->user()->dni) }}"
      }

      window.csrfToken = "{{ csrf_token() }}";

      window.allUsers = <?=$allUsers?>;

      window.signalSent = @json($signalSent);
      
    </script>
  @endif
  
  <script id="videoApp" src="{{asset('js/app.js')}}" ></script>   
@endsection