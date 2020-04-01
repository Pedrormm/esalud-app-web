    <!-- Sidebar -->
    <nav >
    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
        >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ URL::asset('/user/dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item{{ (Request::is('user/dashboard'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        @if ($user->role_id == HV_ROLES::PERM_ADMIN)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Users Heading -->
        <div class="sidebar-heading">
            Users
        </div>

        <!-- Nav Item - Users User management Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>User management</span>
            </a>
            <div id="collapseUserManagement" class="collapse" aria-labelledby="headingUserManagement" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User administration:</h6>
                <a id="navSubitemCreateNewUser" class="collapse-item" href="{{ URL::asset('/user/create') }}">Create new user</a>
                <a id="navSubitemShowUsers" class="collapse-item" href="{{ URL::asset('/user/user') }}">Show all users</a>
                <a id="navSubitemPatientManagement" class="collapse-item" href="{{ URL::asset('/user/patient') }}">Patient management</a>
                <a id="navSubitemStaffManagement" class="collapse-item" href="{{ URL::asset('/user/staff') }}">Staff management</a>
            </div>
            </div>
        </li>
        @endif

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('user/records'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/records') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Medical record</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Communication Heading -->
        <div class="sidebar-heading">
            Communication
        </div>

        <!-- Nav Item - Messaging Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommunication" aria-expanded="true" aria-controls="collapseCommunication">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Messaging</span>
            </a>
            <div id="collapseCommunication" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Messages:</h6>
                <a id="navSubitemMyMessages" class="collapse-item" href="{{ URL::asset('/user/my-messages') }}">My messages</a>
                <a id="navSubitemSendMessage" class="collapse-item" href="{{ URL::asset('/user/send-message') }}">Send message</a>
                <a id="navSubitemChat" class="collapse-item" href="{{ URL::asset('/user/chat') }}">Chat</a>
                <a id="navSubitemVideocall" class="collapse-item" href="{{ URL::asset('/user/videocall') }}">Video call</a>
            </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Appointments Heading -->
        <div class="sidebar-heading">
            Appointments
        </div>

        <!-- Nav Item - Make an appointment -->
        <li class="nav-item{{ (Request::is('user/appointments'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/appointments') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Make an appointment</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        @if ($user->role_id == HV_ROLES::PERM_ADMIN)
            <!-- Adjustments Heading -->
            <div class="sidebar-heading">
                Adjustments
            </div>

            <!-- Nav Item - Role management -->
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::asset('/user/roleManagement') }}"
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Role management</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
    
        @endif

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        </ul>
    </nav>
    <!-- End of Sidebar -->