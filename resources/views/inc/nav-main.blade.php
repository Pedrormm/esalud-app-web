    <!-- Sidebar -->
    <nav>
    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center logoContainer" href="{{ url('/dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <div class="d-flex justify-content-center logo-nav">
                    <img src="{{ url('/images/logo.png') }}" alt="Logo">
                </div>
            </div>
        </a>

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
            <div class="sidebar-brand-text nav-tittle">{{ HV_APP_TITLE_NAME }}</div>
        </a>

        @if(isset($flagsMenuEnabled['DASHBOARD']) && $flagsMenuEnabled['DASHBOARD'])
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item{{ (Request::is('dashboard'))? " active":'' }}">
            <a class="nav-link" href="{{ url('/dashboard') }}">
            {{-- <i class="fas fa-fw fa-tachometer-alt"></i> --}}
            {{-- <i class="fas fa-fw fa-chart-area"></i> --}}
            <i class="fas fa-fw fa-table"></i>  
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
            {{-- <i class="fas fa-fw fa-cog"></i> --}}
            <i class="fas fa-user-friends"></i>
            <span>User management</span>
            </a>
            <div id="collapseUserManagement" class="collapse" aria-labelledby="headingUserManagement" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User administration:</h6>
                @if(isset($flagsMenuEnabled['USER_MANAGEMENT_CREATE']) && $flagsMenuEnabled['USER_MANAGEMENT_CREATE'])
                    <a id="navSubitemCreateNewUser" class="collapse-item" href="{{ url('/user/newUser') }}">Create new user</a>
                @endif
                @if(isset($flagsMenuEnabled['ALL_USERS_SHOW']) && $flagsMenuEnabled['ALL_USERS_SHOW'])
                    <a id="navSubitemShowUsers" class="collapse-item" href="{{ url('/users') }}">Show all users</a>
                @endif   
                @if(isset($flagsMenuEnabled['PATIENT_USER_SHOW']) && $flagsMenuEnabled['PATIENT_USER_SHOW']) 
                    <a id="navSubitemPatientManagement" class="collapse-item" href="{{ url('/patients') }}">Patient management</a>
                @endif    
                @if(isset($flagsMenuEnabled['STAFF_USER_SHOW']) && $flagsMenuEnabled['STAFF_USER_SHOW'])
                    <a id="navSubitemStaffManagement" class="collapse-item" href="{{ url('/staff') }}">Staff management</a>
                @endif

            </div>
            </div>
        </li>
        @endif

        @if(isset($flagsMenuEnabled['PATIENTS_MEDICAL_RECORD_SHOW']) && $flagsMenuEnabled['PATIENTS_MEDICAL_RECORD_SHOW'])

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('records'))? " active":'' }}">
            <a class="nav-link" href="{{ url('records') }}"/>
            {{-- <i class="fas fa-fw fa-table"></i> --}}
            <i class="fas fa-laptop-medical"></i>
            <span>Medical record</span></a>
        </li>
        @endif

        @if(isset($flagsMenuEnabled['OWN_MEDICAL_RECORD_SHOW']) && $flagsMenuEnabled['OWN_MEDICAL_RECORD_SHOW'])

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('ownRecord'))? " active":'' }}">
            <a class="nav-link" href="{{ url('ownRecord') }}"/> 
            {{-- <i class="fas fa-file-medical-alt"></i> --}}
            {{-- <i class="fas fa-file-medical"></i> --}}
            <i class="fas fa-notes-medical"></i>
            <span>My Medical record</span></a>
        </li>
        @endif

        <!-- Nav Item - Medical record -->
        <li class="nav-item{{ (Request::is('treatments'))? " active":'' }}">
            <a class="nav-link" href="{{ url('treatments') }}"/> 
            <i class="fas fa-briefcase-medical"></i>
            <span>Medical treatment</span></a>
        </li>

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
            <span>Communication</span>
            </a>
            <div id="collapseCommunication" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Messages:</h6>
                @if(isset($flagsMenuEnabled['MESSAGING_CHAT_SHOW']) && $flagsMenuEnabled['MESSAGING_CHAT_SHOW'])
                    <a id="navSubitemMessaging" class="collapse-item" href="{{ url('/messaging') }}">Messaging</a>
                @endif
                <a id="navSubitemMyMessages" class="collapse-item" href="{{ url('/messaging/myMessages') }}">My messages</a>
                @if(isset($flagsMenuEnabled['GROUP_CHAT_SHOW']) && $flagsMenuEnabled['GROUP_CHAT_SHOW'])
                    <a id="navSubitemChat" class="collapse-item" href="{{ url('/openvidu/token') }}">Chat</a>
                @endif
                @if(isset($flagsMenuEnabled['VIDEO_CALL_SHOW']) && $flagsMenuEnabled['VIDEO_CALL_SHOW'])
                    <a id="navSubitemVideocall" class="collapse-item" href="{{ url('/videoCall') }}">Video call</a>
                @endif
            </div>
            </div>
        </li>
        @endif

        

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Communication Heading -->
        <div class="sidebar-heading">
            Scheduling
        </div>

        <!-- Nav Item - Messaging Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSchedule" aria-expanded="true" 
            aria-controls="collapseSchedule">
            {{-- <i class="fa fa-calendar"></i> --}}
            <i class="fas fa-clock"></i>
            <span>Schedule</span>
            </a>
            <div id="collapseSchedule" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Messages:</h6>
                {{-- @if(isset($flagsMenuEnabled['MESSAGING_CHAT_SHOW']) && $flagsMenuEnabled['MESSAGING_CHAT_SHOW']) --}}
                    <a id="" class="collapse-item" href="{{ url('/schedule') }}">My schedule</a>
                {{-- @endif --}}
                {{-- @if(isset($flagsMenuEnabled['GROUP_CHAT_SHOW']) && $flagsMenuEnabled['GROUP_CHAT_SHOW']) --}}
                    <a id="" class="collapse-item" href="{{ url('/openvidu/token') }}">Show all personal schedules</a>
                {{-- @endif --}}
            </div>
            </div>
        </li>
        {{-- @endif --}}





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

        <!-- Appointments Heading -->
        <div class="sidebar-heading">
            Appointments
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppoinment" aria-expanded="true" 
            aria-controls="collapseAppoinment">
            <i class="fas fa-calendar-check"></i>
            <span>Appointments</span>
            </a>
            <div id="collapseAppoinment" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Messages:</h6>
                        {{-- @if(auth()->user()->role_id == \HV_ROLES::PATIENT) --}}
                        @if(isset($flagsMenuEnabled['PENDING_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['PENDING_APPOINTMENTS_SHOW'])
                            <a id="navSubitemPendingAppointments" class="collapse-item d-none-doctor d-none-admin" href="{{ url('appointment/listPending') }}">Ver Citas pendientes</a>
                        @endif
                        @if(isset($flagsMenuEnabled['ACCEPTED_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ACCEPTED_APPOINTMENTS_SHOW'])    
                            <a id="navSubitemAcceptedAppointments" class="collapse-item d-none-patient" href="{{ url('appointment/listAccepted') }}">Ver Citas aceptadas</a>
                        @endif
                        {{-- @elseif(in_array(auth()->user()->role_id, [\HV_ROLES::DOCTOR, \HV_ROLES::ADMIN])) --}}
                        @if(isset($flagsMenuEnabled['ALL_MEDIC_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ALL_MEDIC_APPOINTMENTS_SHOW'])
                            <a id="navSubitemShowAppointments" class="collapse-item d-none-patient" href="{{ url('appointment') }}">Ver Citas</a>
                        @endif
                        @if(isset($flagsMenuEnabled['ALL_APPOINTMENTS_SHOW']) && $flagsMenuEnabled['ALL_APPOINTMENTS_SHOW'])
                            <a id="navSubitemShowAllApointments" class="collapse-item d-none-patient" href="{{ url('appointment/all') }}">Ver todas las Citas</a>
                        @endif
                            {{-- @endif --}}
                        @if((isset($flagsMenuEnabled['ANY_APPOINTMENT_CREATE']) && $flagsMenuEnabled['ANY_APPOINTMENT_CREATE']) ||
                         (isset($flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) ||
                         (isset($flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']))
                            <a id="navSubitemCreateAppointment" class="collapse-item" href="{{ url('appointment/create') }}">Crear</a>
                        @endif
                        @if(isset($flagsMenuEnabled['CALENDAR_SHOW']) && $flagsMenuEnabled['CALENDAR_SHOW'])
                            <a id="navSubitemAppointmentCalendar" class="collapse-item" href="{{ url('appointment/calendar') }}">Calendario</a>
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

            <li class="nav-item{{ (Request::is('roles'))? " active":'' }}">
                <a class="nav-link" href="{{ url('roles') }}"/>
                <i class="fas fa-fw fa-cog"></i>
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