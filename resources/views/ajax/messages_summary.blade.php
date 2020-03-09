<h6 class="dropdown-header">
        Message Center
      </h6>
      @foreach (array_slice($userMessages, 0, 4) as $userMessage)

        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="dropdown-list-image mr-3">
            @if ($userMessage['sex']=="male")
                <img class="rounded-circle" src="{{ asset('images/avatars/user_man.PNG') }}" alt="Foto de perfil">                                                               
            @endif
            @if ($userMessage['sex']=="female")
                <img class="rounded-circle" src="{{ asset('images/avatars/user_woman.PNG') }}" alt="Foto de perfil">                                                               
            @endif
            <div class="status-indicator bg-success"></div>
          </div>
          <div class="{{ $userMessage['read']=="0"? " font-weight-bold":'' }}">
            <div class="text-truncate">{{ $userMessage['messageCorrected'] }}</div>
            <div class="small text-gray-500">{{ urldecode($userMessage['name'])." ". urldecode($userMessage['lastname']) }} · 58m</div>
          </div>
        </a>
      @endforeach
      
      <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>