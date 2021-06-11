    <!-- Sidebar -->
    <nav>
    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center logoContainer" href="{{ url('/dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <div class="d-flex justify-content-center logo-nav">
                    <img src="{{ url('/images/logo.png') }}" alt=@lang('messages.logo_stat')>
                </div>
            </div>
        </a>

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
            {{-- <div class="sidebar-brand-text nav-tittle">{{ HV_APP_TITLE_NAME }}</div> --}}
            <div class="sidebar-brand-text nav-tittle">@lang('messages.MY_V_HOSPITAL')</div>
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
            <span>@lang('messages.nav-main_dashboard')</span></a>
        </li>
        @endif

        @if((isset($flagsMenuEnabled['USER_MANAGEMENT_SHOW']) && $flagsMenuEnabled['USER_MANAGEMENT_SHOW']) ||
         (isset($flagsMenuEnabled['MEDICAL_RECORD_SHOW_ALL_PATIENTS']) && $flagsMenuEnabled['MEDICAL_RECORD_SHOW_ALL_PATIENTS']) ||
         (isset($flagsMenuEnabled['MEDICAL_RECORD_SHOW_OWN']) && $flagsMenuEnabled['MEDICAL_RECORD_SHOW_OWN']))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Users Heading -->
            <div class="sidebar-heading">
                @lang('messages.nav-main_users')
            </div>
        @endif

        @if((isset($flagsMenuEnabled['USER_MANAGEMENT_CREATE']) && $flagsMenuEnabled['USER_MANAGEMENT_CREATE']) ||
        (isset($flagsMenuEnabled['ALL_USERS_SHOW']) && $flagsMenuEnabled['ALL_USERS_SHOW']) ||
        (isset($flagsMenuEnabled['PATIENT_USER_SHOW']) && $flagsMenuEnabled['PATIENT_USER_SHOW']) ||
        (isset($flagsMenuEnabled['STAFF_USER_SHOW']) && $flagsMenuEnabled['STAFF_USER_SHOW']))

            <!-- Nav Item - Users User management Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUserManagement" aria-expanded="true" 
                aria-controls="collapseUserManagement">
                {{-- <i class="fas fa-fw fa-cog"></i> --}}
                <i class="fas fa-user-friends"></i>
                <span>@lang('messages.nav-main_user_management')</span>
                </a>
                <div id="collapseUserManagement" class="collapse" aria-labelledby="headingUserManagement" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">@lang('messages.nav-main_user_administration'):</h6>
                    @if(isset($flagsMenuEnabled['USER_MANAGEMENT_CREATE']) && $flagsMenuEnabled['USER_MANAGEMENT_CREATE'])
                        <a id="navSubitemCreateNewUser" class="collapse-item" href="{{ url('/user/newUser') }}">@lang('messages.nav-main_user_management_create_user')</a>
                    @endif
                    @if(isset($flagsMenuEnabled['ALL_USERS_SHOW']) && $flagsMenuEnabled['ALL_USERS_SHOW'])
                        <a id="navSubitemShowUsers" class="collapse-item" href="{{ url('/users') }}">@lang('messages.nav-main_user_management_show_users')</a>
                    @endif   
                    @if(isset($flagsMenuEnabled['PATIENT_USER_SHOW']) && $flagsMenuEnabled['PATIENT_USER_SHOW']) 
                        <a id="navSubitemPatientManagement" class="collapse-item" href="{{ url('/patients') }}">@lang('messages.nav-main_user_management_patient_management')</a>
                    @endif    
                    @if(isset($flagsMenuEnabled['STAFF_USER_SHOW']) && $flagsMenuEnabled['STAFF_USER_SHOW'])
                        <a id="navSubitemStaffManagement" class="collapse-item" href="{{ url('/staff') }}">@lang('messages.nav-main_user_management_staff_management')</a>
                    @endif

                </div>
                </div>
            </li>
        @endif

        @if(isset($flagsMenuEnabled['MEDICAL_RECORD_SHOW_ALL_PATIENTS']) && $flagsMenuEnabled['MEDICAL_RECORD_SHOW_ALL_PATIENTS'])
            <!-- Nav Item - Medical record -->
            <li class="nav-item{{ ((Request::is('records'))||(Request::is('singleRecord*')))? " active":'' }}">
                <a class="nav-link" href="{{ url('records') }}"/>
                {{-- <i class="fas fa-fw fa-table"></i> --}}
                <i class="fas fa-laptop-medical"></i>
                <span>@lang('messages.nav-main_medical_record')</span></a>
            </li>
        @endif

        @if(isset($flagsMenuEnabled['MEDICAL_RECORD_SHOW_OWN']) && $flagsMenuEnabled['MEDICAL_RECORD_SHOW_OWN'])
            <!-- Nav Item - Medical record -->
            <li class="nav-item{{ (Request::is('ownRecord'))? " active":'' }}">
                <a class="nav-link" href="{{ url('ownRecord') }}"/> 
                {{-- <i class="fas fa-file-medical-alt"></i> --}}
                {{-- <i class="fas fa-file-medical"></i> --}}
                <i class="fas fa-notes-medical"></i>
                <span>@lang('messages.nav-main_my_medical_record')</span></a>
            </li>
        @endif

        @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_ALL']) && $flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_ALL'])
            <!-- Nav Item - All treatments -->
            <li class="nav-item{{ (Request::is('treatments*'))? " active":'' }}">
                <a class="nav-link" href="{{ url('treatments') }}"/> 
                <i class="fas fa-briefcase-medical"></i>
                <span>@lang('messages.nav-main_medical_treatment')</span></a>
            </li>
        @endif

        @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_OWN']) && $flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_OWN'])
            <!-- Nav Item - Logged treatment -->
            <li class="nav-item{{ (Request::is('treatments*'))? " active":'' }}">
                <a class="nav-link" href="{{ url('treatments/'.auth()->user()->id.'/indexSinglePatient') }}"/> 
                <i class="fas fa-briefcase-medical"></i>
                <span>@lang('messages.nav-main_my_medical_treatment')</span></a>
            </li>
        @endif
        
        @if((isset($flagsMenuEnabled['MESSAGING_CHAT_SHOW']) && $flagsMenuEnabled['MESSAGING_CHAT_SHOW']) ||
        (isset($flagsMenuEnabled['VIDEO_CALL_SHOW']) && $flagsMenuEnabled['VIDEO_CALL_SHOW']))
        
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Communication Heading -->
            <div class="sidebar-heading">
                @lang('messages.nav-main_communication')
            </div>

            <!-- Nav Item - Messaging Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCommunication" aria-expanded="true" 
                aria-controls="collapseCommunication">
                <i class="fa fa-users"></i>
                <span>@lang('messages.nav-main_communication')</span>
                </a>
                <div id="collapseCommunication" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">@lang('messages.nav-main_communication'):</h6>
                        @if(isset($flagsMenuEnabled['MESSAGING_CHAT_SHOW']) && $flagsMenuEnabled['MESSAGING_CHAT_SHOW'])
                            <a id="navSubitemMessaging" class="collapse-item" href="{{ url('/messaging') }}">@lang('messages.nav-main_communication_messaging')</a>
                        @endif
        
                        @if(isset($flagsMenuEnabled['VIDEO_CALL_SHOW']) && $flagsMenuEnabled['VIDEO_CALL_SHOW'])
                            <a id="navSubitemVideocall" class="collapse-item" href="{{ url('/videoCall') }}">@lang('messages.nav-main_communication_video_call')</a>
                        @endif
                    </div>
                </div>
            </li>
        @endif

        
        @if((isset($flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_OWN']) && $flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_OWN']) ||
        (isset($flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_ALL']) && $flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_ALL']))
        
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Communication Heading -->
            <div class="sidebar-heading">
                @lang('messages.nav-main_scheduling')
            </div>

            <!-- Nav Item - Messaging Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseSchedule" aria-expanded="true" 
                aria-controls="collapseSchedule">
                {{-- <i class="fa fa-calendar"></i> --}}
                <i class="fas fa-clock"></i>
                <span>@lang('messages.nav-main_schedule')</span>
                </a>
                <div id="collapseSchedule" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">@lang('messages.nav-main_schedule'):</h6>
                    @if(isset($flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_OWN']) && $flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_OWN'])
                        <a id="navSubItemMySchedule" class="collapse-item" href="{{ url('/schedule') }}">@lang('messages.nav-main_schedule_my_schedule')</a>
                    @endif
                    @if(isset($flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_ALL']) && $flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_ALL'])
                        <a id="navSubItemAllSchedules" class="collapse-item" href="{{ url('schedule/staff') }}">@lang('messages.nav-main_schedule_show_all_personal_schedules')</a>
                    @endif
                </div>
                </div>
            </li>
        @endif





        @if((isset($flagsMenuEnabled['APPOINTMENT_CREATE_ANY_KIND']) && $flagsMenuEnabled['APPOINTMENT_CREATE_ANY_KIND']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_SHOW_ACCEPTED']) && $flagsMenuEnabled['APPOINTMENT_SHOW_ACCEPTED']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_SHOW_REJECTED']) && $flagsMenuEnabled['APPOINTMENT_SHOW_REJECTED']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_SHOW_PENDING']) && $flagsMenuEnabled['APPOINTMENT_SHOW_PENDING']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_SHOW_ALL']) && $flagsMenuEnabled['APPOINTMENT_SHOW_ALL']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_SHOW_OLD_ONES']) && $flagsMenuEnabled['APPOINTMENT_SHOW_OLD_ONES']) ||
        (isset($flagsMenuEnabled['APPOINTMENT_CALENDAR_SHOW']) && $flagsMenuEnabled['APPOINTMENT_CALENDAR_SHOW']))

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Appointments Heading -->
        <div class="sidebar-heading">
            @lang('messages.nav-main_appointments')
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAppoinment" aria-expanded="true" 
            aria-controls="collapseAppoinment">
            <i class="fas fa-calendar-check"></i>
            <span>@lang('messages.nav-main_appointments')</span>
            </a>
            <div id="collapseAppoinment" class="collapse" aria-labelledby="headingCommunication" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">@lang('messages.nav-main_appointments'):</h6>
                        @if(isset($flagsMenuEnabled['APPOINTMENT_SHOW_PENDING']) && $flagsMenuEnabled['APPOINTMENT_SHOW_PENDING'])
                            <a id="navSubitemPendingAppointments" class="collapse-item d-none-doctor d-none-admin" href="{{ url('appointment/listPending') }}">@lang('messages.nav-main_appointments_show_pending')</a>
                        @endif
                        @if(isset($flagsMenuEnabled['APPOINTMENT_SHOW_ACCEPTED']) && $flagsMenuEnabled['APPOINTMENT_SHOW_ACCEPTED'])    
                            <a id="navSubitemAcceptedAppointments" class="collapse-item d-none-patient" href="{{ url('appointment/listAccepted') }}">@lang('messages.nav-main_appointments_show_accepted')</a>
                        @endif
                        @if(isset($flagsMenuEnabled['APPOINTMENT_SHOW_REJECTED']) && $flagsMenuEnabled['APPOINTMENT_SHOW_REJECTED'])    
                            <a id="navSubitemRejectedAppointments" class="collapse-item d-none-patient" href="{{ url('appointment/listRejected') }}">@lang('messages.nav-main_appointments_show_rejected')</a>
                        @endif
                        @if(isset($flagsMenuEnabled['APPOINTMENT_SHOW_ALL']) && $flagsMenuEnabled['APPOINTMENT_SHOW_ALL'])
                            <a id="navSubitemShowAppointments" class="collapse-item d-none-patient" href="{{ url('appointment') }}">@lang('messages.nav-main_appointments_show_all')</a>
                        @endif
                        @if(isset($flagsMenuEnabled['APPOINTMENT_SHOW_OLD_ONES']) && $flagsMenuEnabled['APPOINTMENT_SHOW_OLD_ONES'])    
                            <a id="navSubitemOldAppointments" class="collapse-item d-none-patient" href="{{ url('appointment/listOld') }}">@lang('messages.nav-main_appointments_show_old')</a>
                        @endif
                        @if((isset($flagsMenuEnabled['APPOINTMENT_CREATE_ANY_KIND']) && $flagsMenuEnabled['APPOINTMENT_CREATE_ANY_KIND']) ||
                         (isset($flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_MEDIC_CREATE']) ||
                         (isset($flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']) && $flagsMenuEnabled['APPOINTMENT_WITH_PATIENT_CREATE']))
                            <a id="navSubitemCreateAppointment" class="collapse-item" href="{{ url('appointment/create') }}">@lang('messages.nav-main_appointments_create')</a>
                        @endif
                        @if(isset($flagsMenuEnabled['APPOINTMENT_CALENDAR_SHOW']) && $flagsMenuEnabled['APPOINTMENT_CALENDAR_SHOW'])
                            <a id="navSubitemAppointmentCalendar" class="collapse-item" href="{{ url('appointment/calendar') }}">@lang('messages.nav-main_appointments_calendar')</a>
                        @endif  
                </div>
            </div>
        </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">


        @if(isset($flagsMenuEnabled['ROLE_MANAGEMENT']) && $flagsMenuEnabled['ROLE_MANAGEMENT'])
            <!-- Adjustments Heading -->
            <div class="sidebar-heading">
                @lang('messages.nav-main_adjustments')
            </div>

            <li class="nav-item{{ (Request::is('roles*'))? " active":'' }}">
                <a class="nav-link" href="{{ url('roles') }}"/>
                <i class="fas fa-fw fa-cog"></i>
                <span>@lang('messages.nav-main_role_management')</span></a>
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

@section('viewsScripts')

{{-- <script>
    $(function() {
        @if(auth()->user()->role_id == \HV_ROLES::ADMIN)
        $('.d-none-patient,.d-none-doctor').hide();
        
    });
</script> --}}

@endsection