                <!-- <script src="{{ asset('js/custom-application.js')}}"></script> -->
<script>
    asyncCall('message/icon', '#messagesDropdown', true);
     $('#messagesDropdown').click();
    asyncCall('message/summary', '#top-navigator-messages', true, false);
    @if($errors->any())
        showInlineError(0, "{{ implode(', ', $errors->all()) }}", 10);
    @endif

    @if(session('js_code'))
        {!! session('js_code') !!}
    @endif
    @isset ($js_code))
        {!! $js_code !!}
    @endisset

    {{-- Code for nav-main.blade.php --}}
    @if((Request::is('user/create') || (Request::is('user/user')) || Request::is('user/patient') 
    || Request::is('user/staff') ))
        $('#collapseUserManagement').collapse('show');
    @elseif((Request::is('user/my-messages') || (Request::is('user/send-message')) || 
    Request::is('user/chat') || Request::is('user/videocall') ))
        $('#collapseCommunication').collapse('show');
    @endif
    
    var dictionary = new Typo("es_ES", false, false, { dictionaryPath: "{{ asset('js/typo/dictionaries')}}" });

    

    @if(Request::is('user/create'))
        $('#navSubitemCreateNewUser').css('background-color', '#eaecf4');
        $('#navSubitemCreateNewUser').addClass('active');
    @elseif(Request::is('user/user'))
        $('#navSubitemShowUsers').css('background-color', '#eaecf4');
        $('#navSubitemShowUsers').addClass('active');
    @elseif(Request::is('user/patient'))
        $('#navSubitemPatientManagement').css('background-color', '#eaecf4');
        $('#navSubitemPatientManagement').addClass('active');
    @elseif(Request::is('user/staff'))
        $('#navSubitemStaffManagement').css('background-color', '#eaecf4');
        $('#navSubitemStaffManagement').addClass('active');
    @endif

    @if(Request::is('user/my-messages'))
        $('#navSubitemMyMessages').css('background-color', '#eaecf4');
        $('#navSubitemMyMessages').addClass('active');
    @elseif(Request::is('comm/messaging'))
        $('#navSubitemMessaging').css('background-color', '#eaecf4');
        $('#navSubitemMessaging').addClass('active');
    @elseif(Request::is('user/send-message'))
        $('#navSubitemSendMessage').css('background-color', '#eaecf4');
        $('#navSubitemSendMessage').addClass('active');
    @elseif(Request::is('user/chat'))
        $('#navSubitemChat').css('background-color', '#eaecf4');
        $('#navSubitemChat').addClass('active');
    @elseif(Request::is('user/videocall'))
        $('#navSubitemVideocall').css('background-color', '#eaecf4');
        $('#navSubitemVideocall').addClass('active');
    @endif
</script>