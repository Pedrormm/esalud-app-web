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
      @yield('content')

      </div>
      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  @include('inc.modals')

  @include('inc.audio')

  @include('inc.jsDeclaration')
  @include('inc.jsGlobalsDefinition')
  @include('inc.jsCustomScripts')

  @include('inc.scripts')

  @yield('viewsScripts')
</body>
</html>
