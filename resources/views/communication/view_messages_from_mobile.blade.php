@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary text-center"></h4>
            </div>
  
            <div class="card-body messagingCardBody">

                <div class="messagingContainer">
                    <div class="conversationMobile" data-selectedUserId={{ $userFound[0]["id"] }}>
                        
                        <div class="cHeader">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <h4>{{ $userFound[0]["name"] . " " . $userFound[0]["lastname"] }}</h4>
                        </div>

                         
                        <div class="cMessagesFeed scroller" style="max-height: 64vh; overflow: scroll;">
                            <ul>
                                @foreach ($userMessages as $userMessage)

                                    @if ($userMessage["user_id_from"] == auth()->user()->id)
                                        <li class="alienUser">
                                            <div class="text">
                                                <span>
                                                    {{ $userMessage["message"] }}
                                                </span>
                                                <p class="dateFeed">
                                                    {{ $userMessage["date_spa"] }}
                                                </p>
                                            <div>                    
                                        </li>
                                    @else
                                        <li class="ownUser">
                                            <div class="text">
                                                <span>
                                                    {{ $userMessage["message"] }}
                                                </span>
                                                <p class="dateFeed">
                                                    {{ $userMessage["date_spa"] }}
                                                </p>
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

@endsection

@section('viewsScripts')
    <script>
        let authUser = @json(auth()->user()->toArray());
    </script>

    <script type="text/javascript" src="{{ asset('js/viewMessagesFromMobile.js')}}"></script>
@endsection
