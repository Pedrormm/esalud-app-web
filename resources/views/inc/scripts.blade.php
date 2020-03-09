                <!-- <script src="{{ asset('js/custom-app.js')}}"></script> -->
<script>
    asyncCall('message/icon', '#messagesDropdown', true);
     $('#messagesDropdown').click();
    asyncCall('message/summary', '#top-navigator-messages', true, false);

    {{-- Code for nav-main.blade.php --}}
    @if((Request::is('user/create') || (Request::is('user/user')) || Request::is('user/patient') || Request::is('user/staff') ))
        $('#collapseUserManagement').collapse('show');
    @endif
    @if(Request::is('user/create'))
        $('#navSubitemCreateNewUser').css('background-color', '#eaecf4');
        $('#navSubitemCreateNewUser').addClass('active');
    @endif
    @if(Request::is('user/user'))
        $('#navSubitemShowUsers').css('background-color', '#eaecf4');
        $('#navSubitemShowUsers').addClass('active');
    @endif
    @if(Request::is('user/patient'))
        $('#navSubitemPatientManagement').css('background-color', '#eaecf4');
        $('#navSubitemPatientManagement').addClass('active');
    @endif
    @if(Request::is('user/staff'))
        $('#navSubitemStaffManagement').css('background-color', '#eaecf4');
        $('#navSubitemStaffManagement').addClass('active');
    @endif
</script>