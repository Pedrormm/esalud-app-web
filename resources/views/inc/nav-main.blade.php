    <!-- Sidebar -->
    <nav>
    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ URL::asset('/user/dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <div class="d-flex justify-content-center logo-nav">
                    <img src="{{ url('/images/logo.png') }}" alt="Logo">
                </div>
            </div>
        </a>

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ URL::asset('/user/dashboard') }}">
            <div class="sidebar-brand-text nav-tittle">{{ HV_APP_TITLE_NAME }}</div>
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

        @if((isset($flagsMenuEnabled['USER_MANAGEMENT_SHOW']) && $flagsMenuEnabled['USER_MANAGEMENT_SHOW']) ||
         (isset($flagsMenuEnabled['PATIENTS_MEDICAL_RECORD_SHOW']) && $flagsMenuEnabled['PATIENTS_MEDICAL_RECORD_SHOW']) ||
         (isset($flagsMenuEnabled['OWN_MEDICAL_RECORD_SHOW']) && $flagsMenuEnabled['OWN_MEDICAL_RECORD_SHOW']))
        {{-- @if ( in_array($user->role_id, [HV_ROLES::DOCTOR,HV_ROLES::HELPER,HV_ROLES::ADMIN],
         true ) )  --}} 

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Users Heading -->
        <div class="sidebar-heading">
            Users
        </div>
        @endif

        @if((isset($flagsMenuEnabled['USER_MANAGEMENT_CREATE']) && $flagsMenuEnabled['USER_MANAGEMENT_CREATE']) ||
        (isset($flagsMenuEnabled['ALL_USERS_SHOW']) && $flagsMenuEnabled['ALL_USERS_SHOW']) ||
        (isset($flagsMenuEnabled['PATIENT_USER_SHOW']) && $flagsMenuEnabled['PATIENT_USER_SHOW']) ||
        (isset($flagsMenuEnabled['STAFF_USER_SHOW']) && $flagsMenuEnabled['STAFF_USER_SHOW']))

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
                @if(isset($flagsMenuEnabled['USER_MANAGEMENT_CREATE']) && $flagsMenuEnabled['USER_MANAGEMENT_CREATE'])
                    <a id="navSubitemCreateNewUser" class="collapse-item" href="{{ URL::asset('/user/newUser') }}">Create new user</a>
                @endif
                @if(isset($flagsMenuEnabled['ALL_USERS_SHOW']) && $flagsMenuEnabled['ALL_USERS_SHOW'])
                    <a id="navSubitemShowUsers" class="collapse-item" href="{{ URL::asset('/users') }}">Show all users</a>
                @endif   
                @if(isset($flagsMenuEnabled['PATIENT_USER_SHOW']) && $flagsMenuEnabled['PATIENT_USER_SHOW']) 
                    <a id="navSubitemPatientManagement" class="collapse-item" href="{{ URL::asset('/users/patient') }}">Patient management</a>
                @endif    
                @if(isset($flagsMenuEnabled['STAFF_USER_SHOW']) && $flagsMenuEnabled['STAFF_USER_SHOW'])
                    <a id="navSubitemStaffManagement" class="collapse-item" href="{{ URL::asset('/users/staff') }}">Staff management</a>
                @endif

            </div>
            </div>
        </li>
        @endif

        @if(isset($flagsMenuEnabled['PATIENTS_MEDICAL_RECORD_SHOW']) && $flagsMenuEnabled['PATIENTS_MEDICAL_RECORD_SHOW'])

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('user/records'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/records') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Medical record</span></a>
        </li>
        @endif

        @if(isset($flagsMenuEnabled['OWN_MEDICAL_RECORD_SHOW']) && $flagsMenuEnabled['OWN_MEDICAL_RECORD_SHOW'])

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('user/records'))? " active":'' }}">
            <a class="nav-link" href="{{ URL::asset('/user/records') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>My Medical record</span></a>
        </li>
        @endif

        @if((isset($flagsMenuEnabled['MESSAGING_CHAT_SHOW']) && $flagsMenuEnabled['MESSAGING_CHAT_SHOW']) ||
        (isset($flagsMenuEnabled['VIDEO_CALL_SHOW']) && $flagsMenuEnabled['VIDEO_CALL_SHOW']) ||
        (isset($flagsMenuEnabled['GROUP_CHAT_SHOW']) && $flagsMenuEnabled['GROUP_CHAT_SHOW']))
        
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
                @if(isset($flagsMenuEnabled['MESSAGING_CHAT_SHOW']) && $flagsMenuEnabled['MESSAGING_CHAT_SHOW'])
                    <a id="navSubitemMessaging" class="collapse-item" href="{{ URL::asset('/comm/messaging') }}">Messaging</a>
                @endif
                <a id="navSubitemMyMessages" class="collapse-item" href="{{ URL::asset('/user/my-messages') }}">My messages</a>
                @if(isset($flagsMenuEnabled['GROUP_CHAT_SHOW']) && $flagsMenuEnabled['GROUP_CHAT_SHOW'])
                    <a id="navSubitemChat" class="collapse-item" href="{{ URL::asset('/openvidu/token') }}">Chat</a>
                @endif
                @if(isset($flagsMenuEnabled['VIDEO_CALL_SHOW']) && $flagsMenuEnabled['VIDEO_CALL_SHOW'])
                    <a id="navSubitemVideocall" class="collapse-item" href="{{ URL::asset('/user/video-call') }}">Video call</a>
                @endif
            </div>
            </div>
        </li>
        @endif

        @if((isset($flagsMenuEnabled['ANY_APPOINTMENT_CREATE']) && $flagsMenuEnabled['ANY_APPOINTMENT_CREATE']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) ||
        (isset($flagsMenuEnabled['ALL_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ALL_APPOINTMENTS_SHOW']) ||
        (isset($flagsMenuEnabled['ALL_MEDIC_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ALL_MEDIC_APPOINTMENTS_SHOW']) ||
        (isset($flagsMenuEnabled['ACCEPTED_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ACCEPTED_APPOINTMENTS_SHOW']) ||
        (isset($flagsMenuEnabled['PENDING_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['PENDING_APPOINTMENTS_SHOW']) ||
        (isset($flagsMenuEnabled['CALENDAR_SHOW']) && $flagsMenuEnabled['CALENDAR_SHOW']))

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
                        @if(isset($flagsMenuEnabled['PENDING_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['PENDING_APPOINTMENTS_SHOW'])
                            <a id="navSubitemMessaging" class="collapse-item d-none-doctor d-none-admin" href="{{ URL::asset('/appointment/list/pending') }}">Ver Citas pendientes</a>
                        @endif
                        @if(isset($flagsMenuEnabled['ACCEPTED_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ACCEPTED_APPOINTMENTS_SHOW'])    
                            <a id="navSubitemMessaging" class="collapse-item d-none-patient" href="{{ URL::asset('/appointment/list/accepted') }}">Ver Citas aceptadas</a>
                        @endif
                        {{-- @elseif(in_array(auth()->user()->role_id, [\HV_ROLES::DOCTOR, \HV_ROLES::ADMIN])) --}}
                        @if(isset($flagsMenuEnabled['ALL_MEDIC_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ALL_MEDIC_APPOINTMENTS_SHOW'])
                            <a id="navSubitemMessaging" class="collapse-item d-none-patient" href="{{ URL::asset('/appointment') }}">Ver Citas</a>
                        @endif
                        @if(isset($flagsMenuEnabled['ALL_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ALL_APPOINTMENTS_SHOW'])
                            <a id="navSubitemMessaging" class="collapse-item d-none-patient" href="{{ URL::asset('/appointment') }}">Ver todas las Citas</a>
                        @endif
                            {{-- @endif --}}
                        @if((isset($flagsMenuEnabled['ANY_APPOINTMENT_CREATE']) && $flagsMenuEnabled['ANY_APPOINTMENT_CREATE']) ||
                         (isset($flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) ||
                         (isset($flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']))
                            <a id="navSubitemMyMessages" class="collapse-item" href="{{ URL::asset('/appointment/create') }}">Crear</a>
                        @endif
                        @if(isset($flagsMenuEnabled['CALENDAR_SHOW']) && $flagsMenuEnabled['CALENDAR_SHOW'])
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
                {{-- <a class="nav-link" href="{{ URL::asset('/user/roleManagement') }}" --}}
                <a class="nav-link" href="{{ URL::asset('/roles') }}"
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