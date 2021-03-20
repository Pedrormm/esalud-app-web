      {{-- Messages List --}}
      <h6 class="dropdown-header">
        Message Center
      </h6>

      @foreach (array_slice($userMessages, 0, 4) as $userMessage)
        {{-- <a class="dropdown-item d-flex align-items-center" href="{{ URL::asset('/comm/messaging').'/'. $userMessage['users_id'] }}"> --}}
        <a class="dropdown-item d-flex align-items-center" data-contact-id="{{ $userMessage['users_id'] }}" href="{{ URL::asset('/comm/messaging') }}">

          {{-- Opcionalmente pasarle el id de un mensaje, para que entre en ese usuario directamente --}}
          <div class="dropdown-list-image mr-3">
            @if ($userMessage['sex']=="male")
                <img class="rounded-circle" src="{{ asset('images/avatars/user_man.png') }}" alt="Foto de perfil">                                                               
            @endif
            @if ($userMessage['sex']=="female")
                <img class="rounded-circle" src="{{ asset('images/avatars/user_woman.png') }}" alt="Foto de perfil">                                                               
            @endif
            <div class="status-indicator bg-success"></div>
          </div>
          <div class="mr-3 top-message {{ $userMessage['unread_count']=="0"? "":'font-weight-bold' }}">
            <div class="text-truncate">{{ $userMessage['messageCorrected'] }}</div>
            <div class="small text-gray-500">{{ urldecode($userMessage['name'])." ". urldecode($userMessage['lastname']) }} · <span class="headerDate">{{ ($userMessage['dateHumanReadable']) }}</span>
            </div>
          </div>
          <div class="mr-3 header-unread">
            @if ($userMessage['unread_count'] == "0")
            @else
              <span class="unread">{{ ($userMessage['unread_count']) }}</span>
            @endif
          </div>

        </a>
      @endforeach
      
      <a class="dropdown-item text-center small text-gray-500" href="{{ URL::asset('/comm/messaging') }}">Read More Messages</a>

      <script>

        $("[data-contact-id]").on('click', function(e){
          e.preventDefault();
          let id = $(this).attr("data-contact-id");
          // console.log(id);
          window.localStorage.setItem("contact-id",id);
          location.href = $(this).attr("href");
        });
        
      </script>