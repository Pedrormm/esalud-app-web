@php header('Access-Control-Allow-Origin: *'); @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  @include('inc.nav-main')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      @include('inc.header')

      @yield('nav-bar-top')
        <div id="error-container" class="alert alert-danger text-center dNone"></div>
        <div id="message-container" class="alert alert-success text-center dNone"></div>
        {{-- @if(isset($successful))
          <div class="row">
            <div class="col-11 mx-auto">
              <div class="alert alert-info text-center">
                {{ $successful }}     
              </div>
            </div>
          </div>
        @endif --}}

      @yield('content')


      </div>
      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  @include('inc.modals')

<audio id="chat-sound" style="display: none">
  <source src="{{ asset('sounds/chat.mp3') }}" />
</audio>

@if(\Route::current()->uri != 'videoCall') 
  @if (auth()->user()) 
  <script>
    window.user = {
      id: {{ (auth()->user()->id) }},
      dni: "{{ (auth()->user()->dni) }}"
    }

    window.csrfToken = "{{ csrf_token() }}";   
    window.allUsers = [];

    window.signalSent = "#";

  </script>

  
  </div>

  <script src="{{asset('js/app.js')}}" >
  </script>

  @endif
@endif


@include('inc.scripts')
@yield('scriptsPropios')
</body>
</html>
