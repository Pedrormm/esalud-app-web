<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
<body>
    @include('inc.audio')
    @include('inc.header')

    @yield('nav-bar-top')
    @include('inc.nav-main')
    <main>
        @yield('content')
    </main>
    <div id="debug" style="display:none"></div>
</body>
</html>
