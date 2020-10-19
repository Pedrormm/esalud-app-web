@extends('layout.logged-without-layout')

@section('content')

    <div id="app" data-userfullname="{{ $userFullName }}" data-sessionname="{{ $sessionName }}" >
      
    </div>

   <script src="{{asset('js/appVideoRoom.js')}}" >
   </script>      
    
@endsection