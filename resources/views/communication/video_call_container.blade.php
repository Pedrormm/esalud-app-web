@extends('layout.logged-without-layout')

@section('content')
    <div id="app" data-userfullname="{{ $userFullName }}" data-sessionname="{{ $sessionName }}" >
      
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    {{-- Pusher --}}
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>

    <script type="text/javascript" src="{{ asset('js/application.js') }}"></script>

    <script src="{{asset('js/appVideoRoom.js')}}" >
    </script>    

@endsection