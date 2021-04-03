<script>

    asyncCall('messaging/icon', '#messagesDropdown', true);
     $('#messagesDropdown').click();
    asyncCall('messaging/summary', '#top-navigator-messages', true, false);
    @if($errors->any())
        showInlineError(0, "{{ implode(', ', $errors->all()) }}", 20);
    @endif

    @if(session('js_code'))
        {!! session('js_code') !!}
    @endif
    @isset ($js_code))
        {!! $js_code !!}
    @endisset

    @if(isset($okMessage))
        showInlineMessage("{{ $okMessage }}", 30);
    @endif  

    {{-- Code for nav-main.blade.php --}}
    if (screen.width >= 1024){
        @if((Request::is('users/create','users*','patients*','staff*')))
            $('#collapseUserManagement').collapse('show');
        @elseif ((Request::is('messaging*','videoCall*','messaging/myMessages','openvidu/token')))
            $('#collapseCommunication').collapse('show');
        @elseif ((Request::is('appointment*')))
            $('#collapseAppoinment').collapse('show');
        @endif
    }
    else{
        $(".sidebar").toggleClass("toggled");
        $('#mainCardShadow').removeClass(['card','shadow']);
    }
    
    @if (!Request::is('videoCallContainer*'))
        var dictionary = new Typo("es_ES", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });
    @endif  

    @if(Request::is('user/create'))
        $('#navSubitemCreateNewUser').css('background-color', '#eaecf4');
        $('#navSubitemCreateNewUser').addClass('active');
    @elseif(Request::is('users*'))
        $('#navSubitemShowUsers').css('background-color', '#eaecf4');
        $('#navSubitemShowUsers').addClass('active');
    @elseif(Request::is('patients*'))
        $('#navSubitemPatientManagement').css('background-color', '#eaecf4');
        $('#navSubitemPatientManagement').addClass('active');
    @elseif(Request::is('staff*'))
        $('#navSubitemStaffManagement').css('background-color', '#eaecf4');
        $('#navSubitemStaffManagement').addClass('active');
    @endif

    @if(Request::is('messaging/myMessages'))
        $('#navSubitemMyMessages').css('background-color', '#eaecf4');
        $('#navSubitemMyMessages').addClass('active');
    @elseif(Request::is('messaging'))
        $('#navSubitemMessaging').css('background-color', '#eaecf4');
        $('#navSubitemMessaging').addClass('active');
    @elseif(Request::is('videoCall'))
        $('#navSubitemVideocall').css('background-color', '#eaecf4');
        $('#navSubitemVideocall').addClass('active');
    @endif

    @if(Request::is('appointment/listPending'))
        $('#navSubitemPendingAppointments').css('background-color', '#eaecf4');
        $('#navSubitemPendingAppointments').addClass('active');
    @elseif(Request::is('appointment/listAccepted'))
        $('#navSubitemAcceptedAppointments').css('background-color', '#eaecf4');
        $('#navSubitemAcceptedAppointments').addClass('active');
    @elseif(Request::is('appointment'))
        $('#navSubitemShowAppointments').css('background-color', '#eaecf4');
        $('#navSubitemShowAppointments').addClass('active');
    @elseif(Request::is('appointment/all'))
        $('#navSubitemShowAllApointments').css('background-color', '#eaecf4');
        $('#navSubitemShowAllApointments').addClass('active');
    @elseif(Request::is('appointment/create'))
        $('#navSubitemCreateAppointment').css('background-color', '#eaecf4');
        $('#navSubitemCreateAppointment').addClass('active');
    @elseif(Request::is('appointment/calendar'))
        $('#navSubitemAppointmentCalendar').css('background-color', '#eaecf4');
        $('#navSubitemAppointmentCalendar').addClass('active');
    @endif
</script>