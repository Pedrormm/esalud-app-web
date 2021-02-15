@php header('Access-Control-Allow-Origin: *'); @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    {{-- @include('inc.head') --}}
<body id="page-top">
@yield('content')

{{-- @include('inc.scripts') --}}

</body>
</html>
