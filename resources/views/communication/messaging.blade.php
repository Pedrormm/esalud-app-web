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

                    {{-- Conversation --}}
                    <div class="conversation">
                        {{-- Conversation header --}}
                        <div class="cHeader">
                          {{-- <h4>{{ contact ? $contact->name. " ".$contact->lastname : "Select a Contact" }}</h4> --}}
                          
                          <h4></h4>
                        </div>
                        {{-- --end Conversation header --}}

                        {{-- Messages feed --}}
                        <div class="cMessagesFeed selectAContact">
                          <span>Select a Contact...</span>
                        </div>
                        {{-- --end Messages feed --}}

                        {{-- Message composer --}}
                        <div class="cMessageComposer">
                          <textarea placeholder="Write a message..."></textarea>
                        </div>
                        {{-- --end Message composer --}}
                    </div>
                    {{-- --end Conversation --}}

                    {{-- List of Contacts --}}
                    <div class="contactsList scroller">
                      <ul>
                        @foreach ($contacts as $contact)
                          <li value={{ $contact->id }} >
                            <div class="contactAvatar">
                              @if (!empty($contact->avatar))
                                <img class="avatar" src="{{ asset('images/avatars/'.$user->avatar) }}" 
                                alt={{ $contact->name. " ".$contact->lastname }}  class="avatar big">                                                               
                              @else
                                  @if ($contact->sex=="male")
                                      <img class="avatarContactSize avatar" src="{{ asset('images/avatars/user_man.PNG') }}">                                                               
                                  @endif
                                  @if ($contact->sex=="female")
                                      <img class="avatarContactSize avatar" src="{{ asset('images/avatars/user_woman.PNG') }}">                                                               
                                  @endif
                              @endif
                            </div>

                            <div class="contactInfo">
                              <p class="fullName">{{ $contact->name. " ".$contact->lastname }}</p>
                              <p class="dni">{{ $contact->dni }}</p>
                            </div>                    
                          </li>
                          
                        @endforeach

                      </ul>
                    </div>
                    {{-- --end List of Contacts --}}

                </div>
            </div>

        
        </div>
        <!-- /.container-fluid -->

    <script>
          let authUser = @json($user->toArray());
          let contacts = @json($contacts->toArray());
    </script>

    <script type="text/javascript" src="{{ asset('js/messaging.js')}}"></script>
@endsection