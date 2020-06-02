  @if (auth()->user())
    <script>
      window.user = {
        id: {{ ($user->id) }},
        dni: "{{ ($user->dni) }}"
      }

      window.csrfToken = "{{ csrf_token() }}";

      window.allUsers = <?=$allUsers?>;

      window.signalSent = @json($signalSent);
      

    </script>
  @endif

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">Videollamada</h4>
      </div>
      <div class="card-body">
        <div id="app">
          
        </div>
        
        <div id="videoConf">
          
        </div>
      </div>

  </div>
  <!-- /.container-fluid -->
  
</div>
  <script src="{{asset('js/app.js')}}" >
  </script>
                 
    
