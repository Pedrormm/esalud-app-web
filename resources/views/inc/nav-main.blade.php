    <!-- Sidebar -->
    <nav>
    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ URL::asset('/user/dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
        </a>

        @if(isset($flagsMenuEnabled['DASHBOARD']) && $flagsMenuEnabled['DASHBOARD'])
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item{{ (Request::is('user/dashboard'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        @endif

        @if((isset($flagsMenuEnabled['USER_MANAGEMENT']) && $flagsMenuEnabled['USER_MANAGEMENT']) ||
         (isset($flagsMenuEnabled['SHOW_PATIENTS_MEDICAL_RECORD']) && $flagsMenuEnabled['SHOW_PATIENTS_MEDICAL_RECORD']) ||
         (isset($flagsMenuEnabled['SHOW_OWN_MEDICAL_RECORD']) && $flagsMenuEnabled['SHOW_OWN_MEDICAL_RECORD']))
        {{-- @if ( in_array($user->role_id, [HV_ROLES::DOCTOR,HV_ROLES::HELPER,HV_ROLES::ADMIN],
         true ) )  --}} 

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Users Heading -->
        <div class="sidebar-heading">
            Users
        </div>
        @endif

        @if(isset($flagsMenuEnabled['USER_MANAGEMENT']) && $flagsMenuEnabled['USER_MANAGEMENT'])

        <!-- Nav Item - Users User management Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" 
            aria-controls="collapseUserManagement">
            <i class="fas fa-fw fa-cog"></i>
            <span>User management</span>
            </a>
            <div id="collapseUserManagement" class="collapse" aria-labelledby="headingUserManagement" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User administration:</h6>
                <a id="navSubitemCreateNewUser" class="collapse-item" href="{{ URL::asset('/user/newUser') }}">Create new user</a>
                <a id="navSubitemShowUsers" class="collapse-item" href="{{ URL::asset('/users') }}">Show all users</a>
                <a id="navSubitemPatientManagement" class="collapse-item" href="{{ URL::asset('/users/patient') }}">Patient management</a>
                <a id="navSubitemStaffManagement" class="collapse-item" href="{{ URL::asset('/users/staff') }}">Staff management</a>
            </div>
            </div>
        </li>
        @endif

        @if(isset($flagsMenuEnabled['SHOW_PATIENTS_MEDICAL_RECORD']) && $flagsMenuEnabled['SHOW_PATIENTS_MEDICAL_RECORD'])

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('user/records'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/records') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Medical record</span></a>
        </li>
        @endif

        @if(isset($flagsMenuEnabled['SHOW_OWN_MEDICAL_RECORD']) && $flagsMenuEnabled['SHOW_OWN_MEDICAL_RECORD'])

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('user/records'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/records') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>My Medical record</span></a>
        </li>
        @endif

        @if((isset($flagsMenuEnabled['SHOW_MESSAGING_CHAT']) && $flagsMenuEnabled['SHOW_MESSAGING_CHAT']) ||
        (isset($flagsMenuEnabled['SHOW_VIDEO_CALL']) && $flagsMenuEnabled['SHOW_VIDEO_CALL']) ||
        (isset($flagsMenuEnabled['SHOW_GROUP_CHAT']) && $flagsMenuEnabled['SHOW_GROUP_CHAT']))
        
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Communication Heading -->
        <div class="sidebar-heading">
            Communication
        </div>

        <!-- Nav Item - Messaging Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommunication" aria-expanded="true" 
            aria-controls="collapseCommunication">
            <i class="fa fa-users"></i>
            <span>Messaging</span>
            </a>
            <div id="collapseCommunication" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Messages:</h6>
                @if(isset($flagsMenuEnabled['SHOW_MESSAGING_CHAT']) && $flagsMenuEnabled['SHOW_MESSAGING_CHAT'])
                    <a id="navSubitemMessaging" class="collapse-item" href="{{ URL::asset('/comm/messaging') }}">Messaging</a>
                @endif
                <a id="navSubitemMyMessages" class="collapse-item" href="{{ URL::asset('/user/my-messages') }}">My messages</a>
                @if(isset($flagsMenuEnabled['SHOW_GROUP_CHAT']) && $flagsMenuEnabled['SHOW_GROUP_CHAT'])
                    <a id="navSubitemChat" class="collapse-item" href="{{ URL::asset('/openvidu/token') }}">Chat</a>
                @endif
                @if(isset($flagsMenuEnabled['SHOW_VIDEO_CALL']) && $flagsMenuEnabled['SHOW_VIDEO_CALL'])
                    <a id="navSubitemVideocall" class="collapse-item" href="{{ URL::asset('/user/video-call') }}">Video call</a>
                @endif
            </div>
            </div>
        </li>
        @endif

        @if((isset($flagsMenuEnabled['CREATE_ANY_APPOINTMENT']) && $flagsMenuEnabled['CREATE_ANY_APPOINTMENT']) ||
        (isset($flagsMenuEnabled['CREATE_APPOINTMENT_WITH_MEDIC']) && $flagsMenuEnabled['CREATE_APPOINTMENT_WITH_MEDIC']) ||
        (isset($flagsMenuEnabled['CREATE_APPOINTMENT_WITH_PATIENT']) && $flagsMenuEnabled['CREATE_APPOINTMENT_WITH_PATIENT']) ||
        (isset($flagsMenuEnabled['SHOW_ALL_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_ALL_APPOINTMENTS']) ||
        (isset($flagsMenuEnabled['SHOW_ALL_MEDIC_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_ALL_MEDIC_APPOINTMENTS']) ||
        (isset($flagsMenuEnabled['SHOW_ACCEPTED_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_ACCEPTED_APPOINTMENTS']) ||
        (isset($flagsMenuEnabled['SHOW_PENDING_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_PENDING_APPOINTMENTS']) ||
        (isset($flagsMenuEnabled['SHOW_CALENDAR']) && $flagsMenuEnabled['SHOW_CALENDAR']))

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppoinment" aria-expanded="true" 
            aria-controls="collapseAppoinment">
            <i class="fa fa-users"></i>
            <span>Appointments</span>
            </a>
            <div id="collapseAppoinment" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Messages:</h6>
                        {{-- @if(auth()->user()->role_id == \HV_ROLES::PATIENT) --}}
                        @if(isset($flagsMenuEnabled['SHOW_PENDING_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_PENDING_APPOINTMENTS'])
                            <a id="navSubitemMessaging" class="collapse-item d-none-doctor d-none-admin" href="{{ URL::asset('/appointment/list/pending') }}">Ver Citas pendientes</a>
                        @endif
                        @if(isset($flagsMenuEnabled['SHOW_ACCEPTED_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_ACCEPTED_APPOINTMENTS'])    
                            <a id="navSubitemMessaging" class="collapse-item d-none-patient" href="{{ URL::asset('/appointment/list/accepted') }}">Ver Citas aceptadas</a>
                        @endif
                        {{-- @elseif(in_array(auth()->user()->role_id, [\HV_ROLES::DOCTOR, \HV_ROLES::ADMIN])) --}}
                        @if(isset($flagsMenuEnabled['SHOW_ALL_MEDIC_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_ALL_MEDIC_APPOINTMENTS'])
                            <a id="navSubitemMessaging" class="collapse-item d-none-patient" href="{{ URL::asset('/appointment') }}">Ver Citas</a>
                        @endif
                        @if(isset($flagsMenuEnabled['SHOW_ALL_APPOINTMENTS']) && $flagsMenuEnabled['SHOW_ALL_APPOINTMENTS'])
                            <a id="navSubitemMessaging" class="collapse-item d-none-patient" href="{{ URL::asset('/appointment') }}">Ver todas las Citas</a>
                        @endif
                            {{-- @endif --}}
                        @if((isset($flagsMenuEnabled['CREATE_ANY_APPOINTMENT']) && $flagsMenuEnabled['CREATE_ANY_APPOINTMENT']) ||
                         (isset($flagsMenuEnabled['CREATE_APPOINTMENT_WITH_MEDIC']) && $flagsMenuEnabled['CREATE_APPOINTMENT_WITH_MEDIC']) ||
                         (isset($flagsMenuEnabled['CREATE_APPOINTMENT_WITH_PATIENT']) && $flagsMenuEnabled['CREATE_APPOINTMENT_WITH_PATIENT']))
                            <a id="navSubitemMyMessages" class="collapse-item" href="{{ URL::asset('/appointment/create') }}">Crear</a>
                        @endif
                        @if(isset($flagsMenuEnabled['SHOW_CALENDAR']) && $flagsMenuEnabled['SHOW_CALENDAR'])
                            <a id="navSubitemMyMessages" class="collapse-item" href="{{ URL::asset('/appointment/calendar') }}">Calendario</a>
                        @endif  
                </div>
            </div>
        </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">


        @if(isset($flagsMenuEnabled['ROLE_MANAGEMENT']) && $flagsMenuEnabled['ROLE_MANAGEMENT'])
        {{-- @if (auth()->user()->role_id == HV_ROLES::ADMIN) --}}
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

@section('scriptsPropios')

{{-- <script>
    $(function() {
        @if(auth()->user()->role_id == \HV_ROLES::ADMIN)
        $('.d-none-patient,.d-none-doctor').hide();
        
    });
</script> --}}

@endsection