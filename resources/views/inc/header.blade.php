

  

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-dark-blue topbar mb-4 static-top shadow " >

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto" id="topbar-navheader">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." 
          aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>

  <!-- Languages -->
  {{-- Icons from https://flagicons.lipis.dev/ --}}
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="languagesDropdown" role="button" data-toggle="dropdown" 
    aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-flag"></i>
      <img id="headerTopFlag" data-language={{ app()->getLocale() }}
      src="https://lipis.github.io/flag-icon-css/flags/4x3/es.svg" alt="Selected Flag">
    </a>
    
    <!-- Dropdown - Languages -->
    <div id="dropLanguages" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
    aria-labelledby="languagesDropdown">
      <h6 class="dropdown-header">
        Idiomas
      </h6>
      <a class="dropdown-item d-flex align-items-center" href="{{ url('/setLanguage/en') }}">
        <div class="mr-3">
          <div class="">
            <img class="headerFlag" src="https://lipis.github.io/flag-icon-css/flags/4x3/um.svg" alt="United States Flag">
          </div>
        </div>
        <div>
          {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
          <span class="font-weight-bold">@lang('messages.language English')</span>
        </div>
      </a>
      <a class="dropdown-item d-flex align-items-center" href="{{ url('/setLanguage/es') }}">
        <div class="mr-3">
          <div class="">
            <img class="headerFlag" src="https://lipis.github.io/flag-icon-css/flags/4x3/es.svg" alt="Spain Flag">
          </div>
        </div>
        <div>
          {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
          <span class="font-weight-bold">@lang('messages.language Spanish')</span>
        </div>
      </a>

      <a class="dropdown-item d-flex align-items-center" href="{{ url('/setLanguage/it') }}">
        <div class="mr-3">
          <div class="">
            <img class="headerFlag" src="https://lipis.github.io/flag-icon-css/flags/4x3/it.svg" alt="Italy Flag">
          </div>
        </div>
        <div>
          {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
          <span class="font-weight-bold">@lang('messages.language Italian')</span>
        </div>
      </a>

    

    </div>
  </li>
  
  <!-- Nav Item - Alerts -->
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell fa-fw"></i>
      <!-- Counter - Alerts -->
      {{-- <span class="badge badge-danger badge-counter">3+</span> --}}
    </a>
    <!-- Dropdown - Alerts for Appointments -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Alerts Center
      </h6>
      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            {{-- <i class="fas fa-file-alt text-white"></i> --}}
            <i class="fas fa-calendar-check text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500">December 12, 2019</div>
          <span class="font-weight-bold">A new monthly report is ready to download!</span>
        </div>
      </a>
      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
        <div class="mr-3">
          <div class="icon-circle bg-success">
            <i class="fas fa-donate text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500">December 7, 2019</div>
          $290.29 has been deposited into your account!
        </div>
      </a>
      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
        <div class="mr-3">
          <div class="icon-circle bg-warning">
            <i class="fas fa-exclamation-triangle text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500">December 2, 2019</div>
          Spending Alert: We've noticed unusually high spending for your account.
        </div>
      </a>
      <a class="dropdown-item text-center small text-gray-500" href="javascript:void(0);">Show All Alerts</a>
    </div>
  </li>

  <!-- Nav Item - Messages -->
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="messagesDropdown" role="button" data-toggle="dropdown" 
    aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-envelope fa-fw"></i>
      <!-- Counter - Messages -->
      <!-- <span class="badge badge-danger badge-counter">8</span> -->
    </a>
    <!-- Dropdown - Messages -->
    <div id="top-navigator-messages" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
    aria-labelledby="messagesDropdown">
 
    </div>
  </li>

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 " style="color:white !important">{{  Auth::user()->name }}</span>
      {{-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> --}}
      @if (!empty(auth()->user()->avatar))
          <img src="{{ asset('images/avatars/'.auth()->user()->avatar) }}" class="img-profile rounded-circle" alt="Profile picture" id="profilePicture"/>
      @else
          @if (auth()->user()->sex=="male")
              <img src="{{ asset('images/avatars/user_man.png') }}" class="img-profile rounded-circle" alt="Profile picture" id="profilePicture"/>                                                               
          @endif
          @if (auth()->user()->sex=="female")
              <img src="{{ asset('images/avatars/user_woman.png') }}" class="img-profile rounded-circle" alt="Profile picture" id="profilePicture"/>                                                               
          @endif
      @endif
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      {{-- <a class="dropdown-item" href="javascript:void(0);">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profile
      </a> --}}
      <a class="dropdown-item" href="{{ URL::asset('/settings/index') }}">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Settings
      </a>
      {{-- <a class="dropdown-item" href="javascript:void(0);">
        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
        Activity Log
      </a> --}}
      <div class="dropdown-divider"></div>
      <a href="{{ URL::asset('/logout') }}" class="dropdown-item" data-toggle="modal" data-target="#logoutModal" onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout    
      <form id="logout-form" action="{{ URL::asset('/logout') }}"method="POST" class="d-none">
          {{ csrf_field() }}
      </form>      
      </a>

    </div>
  </li>

</ul>

</nav>
<!-- End of Topbar -->