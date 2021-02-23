@extends('layout.logged-without-layout')

@section('content')
    <div id="app" data-userfullname="{{ $userFullName }}" data-sessionname="{{ $sessionName }}" >
      
    </div>
    
    <script type="text/javascript" src="{{ asset('js/application.js') }}"></script>

    <script src="{{asset('js/appVideoRoom.js')}}" >
    </script>    

@endsection