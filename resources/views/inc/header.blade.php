<header>
    <nav class="header">
        <div class="header_avatar hidden-xs hidden-sm">
            <img class="avatar big" src="{{ asset('images/avatars/admin.PNG') }}"> 
        </div>
        <a class="hidden-md hidden-lg">
            <i class="fa fa-bars"></i>
        </a>
        <a name="dashboard" href="{{ URL::asset('/user/dashboard') }}">
            <i class="fa fa-hospital-o"></i>
        </a>
    </nav>
    <h4 class="hidden-xs hidden-sm" style="position: absolute;left: 75px;top: 0;text-transform: capitalize;font-size: 14px;padding: 17px 0;">Bienvenido     {{ $user->name . ' ' . $user->lastname }}
</h4>
    <h4>{{ env('APP_NAME') }}</h4>
</header>