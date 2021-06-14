
    $(function() {
        $(".cMessageComposer textarea").focus();
        scrollToBottom(".cMessagesFeed");
    });

    let pusher = chatPusherInit();
    let chatPusher = pusher[0];
    let chatChannel = pusher[1];

    chatChannel.bind(`client-send`, (data) => {
        console.log("Recibido client-send Mobile", data);
        if (data.idReceiver == authUser.id){
            let written = saveNewMessage(data, false, data.idSender );
            if (!written){
                let alert_sound = document.getElementById("chat-sound");
                console.log(alert_sound);
                alert_sound.play();
            }
        }
    });

    $('.cHeader button').on('click', function(e){
        e.preventDefault();
        window.location.href = _publicUrl+"messaging";
    });

    $('.cMessagesFeed').bind('DOMSubtreeModified', function(e) {
        if (e.target.innerHTML.length > 0) {
            scrollToBottom(".cMessagesFeed");
            $.ajax(_publicUrl + 'messaging/updateReadMessages', {
                dataType: 'json',
                data: {id: $(".conversationMobile").attr("data-selectedUserId")},
                method:'get',
            }).done(function(res){
               
            })
            .fail(function(xhr, st, err) {
                console.error("error in messaging/updateReadMessages " + xhr, st, err);
            }); 
        }
        
    });

    $( ".cMessagesFeed" ).css({"overflow": "hidden", "overflow-x": "hidden", "overflow-y": "hidden"});
    $( ".cMessagesFeed" ).hover(function() {
        $( this ).css({"overflow-x": "hidden", "overflow-y": "auto", "scroll-snap-type": "y mandatory"});
    }, function(){
        $(this).css({"overflow": "hidden", "overflow-y": "hidden"});
    })

    let width = $(window).width();
    if (width < 450) {
        if ($(".sidebar").hasClass("toggled")) {
            $(".cMessageComposer textarea").attr("placeholder", "Write...");
        }
        else{
            $(".cMessageComposer textarea").attr("placeholder", "");
        }

        $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
            if ($(".sidebar").hasClass("toggled")) {
                $(".cMessageComposer textarea").attr("placeholder", "");
            }
            else{
                $(".cMessageComposer textarea").attr("placeholder", "Write...");
            };
        });  
    } 
    // _messagesLocalization.write_stat+"..."
    
    $(".cMessageComposer textarea").keydown(function(event){
        if(event.key === 'Enter') {
            event.preventDefault();
            let writtenMessage = $(".cMessageComposer textarea");
            sendMessage(writtenMessage, $(".conversationMobile").attr("data-selectedUserId"),
            authUser.id, chatChannel);
        }
    });

    $('#buttonSendMessage').click(function(event) {
        event.preventDefault();
        let writtenMessage = $(".cMessageComposer textarea");
        sendMessage(writtenMessage, $(".conversationMobile").attr("data-selectedUserId"),
        authUser.id, chatChannel);
        scrollToBottom(".cMessagesFeed");
    });
