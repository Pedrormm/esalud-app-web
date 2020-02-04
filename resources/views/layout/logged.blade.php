<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body>
    @include('inc.audio')
    @include('inc.header')

    @include('inc.nav-bar-top')
    @include('inc.nav-bar-left')
    @include('inc.nav-main')
    <main>
        @yield('content')
    </main>
    <script type="text/javascript">
        $(function(){
            _Navigator.go("main");
        })
    </script>
</body>
</html>
