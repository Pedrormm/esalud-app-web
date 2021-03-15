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
        <div id="error-container" class="alert alert-danger dNone"></div>
        <div id="message-container" class="alert alert-success dNone"></div>
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

@if(\Route::current()->uri != 'user/video-call') 
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
