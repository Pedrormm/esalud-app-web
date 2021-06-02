<i class="fas fa-envelope fa-fw"></i>
<!-- Counter - Messages -->
<span class="badge badge-danger badge-counter" id="numMessagesHeader">
    {{(($nMessages>0 && $nMessages<100) ? $nMessages : ($nMessages>99 ? "99+": ""))}}
</span>

{{-- @section('viewsScripts') --}}
    <script>
        window.authUser = @json(auth()->user()->toArray());
        window.nMessages = {{ $nMessages }};

        if (nMessages < 1){
            $('#numMessagesHeader').empty();
            $('#numMessagesHeader').removeClass("badge");
        }
        else{
            $('#numMessagesHeader').addClass("badge");
        }

        if (!(window.location.href.startsWith(_publicUrl+'messaging')) &&
        !(window.location.href.startsWith(_publicUrl+'messaging/viewMessagesFromMobile')) ){
            window.pusher = chatPusherInit();
            window.chatPusher = pusher[0];
            window.chatChannel = pusher[1];

            chatChannel.bind(`client-send`, (data) => {
                console.log("Recibido client-send Message_icon", data);
                let selectedValue = $('.selectedContact').attr("value");
                if (data.idReceiver == authUser.id) {
                    if (selectedValue){
                        if (selectedValue.toString().trim() !== data.idSender.toString().trim()) {
                            console.log("if: ",data.idSender.toString().trim());
                            updateHeaderMessages(true, data.idSender.toString().trim(), data.message);        
                        }
                    }
                    else{
                        console.log("else: ",data.idSender.toString().trim(), data.message);
                        updateHeaderMessages(true, data.idSender.toString().trim(), data.message);        
                    }
                    let alert_sound = document.getElementById("chat-sound");
                    console.log(alert_sound);
                    alert_sound.play();
                }
            });
        }

    </script>
{{-- @endsection --}}



