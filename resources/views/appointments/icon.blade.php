<i class="fas fa-bell fa-fw"></i>
<!-- Counter - Appointments -->
<span class="badge badge-danger badge-counter" id="numAppointmentsHeader">
    {{(($nAppointments>0 && $nAppointments<100) ? $nAppointments : ($nAppointments>99 ? "99+": null))}}
</span>


@section('viewsScripts')
    <script>
        window.authUser = @json(auth()->user()->toArray());
        window.nAppointments = {{ $nAppointments }};

        if (nAppointments < 1){
            $('#numAppointmentsHeader').empty();
            $('#numAppointmentsHeader').removeClass("badge");
        }
        else{
            $('#numAppointmentsHeader').addClass("badge");
        }


            window.pusher = chatPusherInit(false);
            window.chatChannel = pusher[1];
            console.log("pusher ",window.pusher);
            chatChannel.bind(`client-send`, (data) => {
                console.log("Recibido client-send Appointment_icon", data);
            });
    </script>
@endsection



