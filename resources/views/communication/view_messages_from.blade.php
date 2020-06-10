@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center"></h4>
            </div>
  
            <div class="card-body messagingCardBody">

                <div class="messagingContainer">
                    <div class="conversationMobile" data-contact="#selectedContact">
                        
                        <div class="cHeader">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <h4>{{ $userFound[0]["name"] . " " . $userFound[0]["lastname"] }}</h4>
                        </div>

                                   
                        <div class="cMessagesFeed scroller" style="max-height: 64vh; overflow: scroll;">
                            <ul>
                                {{-- <li class="ownUser"><div class="text">Hola, da cita a Gema</div>
                                </li> --}}
                                @foreach ($userMessages as $userMessage)

                                    @if ($userMessage["user_id_from"] == $user->id)
                                        <li class="alienUser">
                                            <div class="text">
                                                {{ $userMessage["message"] }}
                                            <div>                    
                                        </li>
                                    @else
                                        <li class="ownUser">
                                            <div class="text">
                                                {{ $userMessage["message"] }}
                                            <div>                    
                                        </li>
                                    @endif                                                          
                        
                                @endforeach

                            </ul>
                        </div>
                    
                        <div class="cMessageComposer">
                            <textarea placeholder="Write..." autofocus></textarea>
                            {{-- <button type="button" class="btn btn-primary"> --}}
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            {{-- </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script type="text/javascript" src="{{ asset('js/viewMessagesFrom.js')}}"></script>

<script>

</script>

    
@endsection