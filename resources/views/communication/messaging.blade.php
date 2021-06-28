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

                    {{-- Conversation --}}
                    <div class="conversation">
                        {{-- Conversation header --}}
                        <div class="cHeader">
                          {{-- <h4>{{ contact ? $contact->name. " ".$contact->lastname : @lang('messages.select_a_contact') }}</h4> --}}
                          
                          <h4></h4>
                        </div>
                        {{-- --end Conversation header --}}

                        {{-- Messages feed --}}
                        <div class="cMessagesFeed selectAContact">
                          <span>@lang('messages.select_a_contact')...</span>
                        </div>
                        {{-- --end Messages feed --}}

                        {{-- Message composer --}}
                        <div class="cMessageComposer">
                          <textarea placeholder="@lang('messages.write_a_message')"></textarea>
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
                                <img class="avatarContactSize avatar" src="{{ asset('images/avatars/'.$contact->avatar) }}">                                                                 
                              @else
                                @if ($contact->sex=="male")
                                    <img class="avatarContactSize avatar" src="{{ asset('images/avatars/user_man.png') }}">                                                               
                                @endif
                                @if ($contact->sex=="female")
                                    <img class="avatarContactSize avatar" src="{{ asset('images/avatars/user_woman.png') }}">                                                               
                                @endif
                              @endif
                            </div>

                            <div class="contactInfo">
                              <p class="fullName">{{ $contact->name. " ".$contact->lastname }}</p>
                              <p class="dni">{{ $contact->dni }}</p>
                              @if ($contact->unread)
                                <p class="dateInfo">{{ $contact->dateHumanReadable }}</p>
                              @endif
                            </div>
                            @if ($contact->unread)
                              <span class="unread">{{ $contact->unread }}</span>
                            @endif
                          </li>
                          
                        @endforeach

                      </ul>
                    </div>

                    {{-- --end List of Contacts --}}

                </div>
            </div>

        
        </div>
        <!-- /.container-fluid -->


@endsection

@section('viewsScripts')
  <script>
    let authUser = @json(auth()->user()->toArray());
    let contacts = @json($contacts->toArray());
  </script>

  <script type="text/javascript" src="{{ asset('js/messaging.js')}}"></script>
@endsection