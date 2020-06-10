    $(function() {
        $(".cMessageComposer textarea").focus();
        scrollToBottom(".cMessagesFeed");
    });

    $('.cHeader button').on('click', function(e){
        e.preventDefault();
        window.location.href = PublicURL+"comm/messaging";
    });

    $('.cMessagesFeed').bind('DOMSubtreeModified', function(e) {
        if (e.target.innerHTML.length > 0) {
            scrollToBottom(".cMessagesFeed");
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
    
    $(".cMessageComposer textarea").keydown(function(event){
        if(event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }

    });
    $('.cMessageComposer i').on('click', function(e){
        e.preventDefault();
        sendMessage();
    });