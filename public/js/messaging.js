
let pusher = chatPusherInit();
let chatPusher = pusher[0];
let chatChannel = pusher[1];

chatChannel.bind(`client-send`, (data) => {
    console.log("Recibido client-send Contactos", data);
    if (data.idReceiver == authUser.id){
        let written = saveNewMessage(data,false,data.idSender);
        updateUnread(data.idSender, false, written);
        if (written){
            $.ajax(PublicURL + 'comm/updateReadMessages', {
                dataType: 'json',
                data: {id: data.idSender},
                method:'get',
            }).done(function(res){
            })
            .fail(function(xhr, st, err) {
                console.error("error in comm/updateReadMessages " + xhr, st, err);
            }); 
        }
        else{
            let alert_sound = document.getElementById("chat-sound");
            console.log(alert_sound);
            alert_sound.play();
        }
    }
});

let width = $(window).width();

function updateUnread(contactId, reset, written=false) {
    let found = $('.contactsList li[value='+contactId+']');
    if (found[0]){
        let unReadFound = found.find('.unread');
        let dateInfoFound = found.find('.dateInfo');
        if (reset){
            if (unReadFound[0])
                unReadFound.remove();
            if (dateInfoFound[0])
                dateInfoFound.remove();               
        }
        else{
            if (!written){
                if (unReadFound[0]){
                    unReadFound.text(parseInt(unReadFound.text())+1);
                }
                else{
                    found.append($('<span />').addClass("unread").text('1'));
                }
                if (dateInfoFound[0]){
                    dateInfoFound.text('A while ago');
                }
                else{
                    found.find('.contactInfo').append($('<p />').addClass("dateInfo").text('A while ago'));
                } 
            }
        }
    }
    else{
        console.log("Not found");
    }
}

function dropdownDisplay(el) {
    let dropdown = el.parentNode.querySelector('.dropdown-content');
    dropdown.style.display="block";
}


if (width < 768) {
    $('.contactsList li').click(function(e) {
        let selectedId = $(this).val();
        let selectedContactNotReadMessages = this.querySelector("span");
        if (selectedContactNotReadMessages)
            updateHeaderMessages(false, parseInt(selectedContactNotReadMessages.innerText.trim()));
        updateUnread(selectedId, true);
        $.ajax(PublicURL + 'comm/updateReadMessages', {
            dataType: 'json',
            data: {id: selectedId},
            method:'get',
        }).done(function(res){
            location.assign(PublicURL+"comm/viewMessagesFromMobile"+"/"+selectedId);
        })
        .fail(function(xhr, st, err) {
            console.error("error in comm/updateReadMessages " + xhr, st, err);
        }); 
    });
} 
else {
    
    $(".cMessageComposer textarea").prop( "disabled", true );
    $(".cMessageComposer textarea").css("display", "none");

    let contactId=localStorage.getItem("contact-id");
    if (contactId){
        localStorage.removeItem("contact-id");
        handleContactClick(null, contactId);
    }

    const arrContacts = Array.from(document.querySelectorAll('.contactsList li'));

    function handleContactClick(e,requiredId=null) {

        // Removing last URL parameters without refreshing page
        let localizacion = location.href;
        let finalCharacters = localizacion.substring(localizacion.lastIndexOf('/')+1, localizacion.length)
        if ((localizacion.substr(-1) !== "/") && !(isNumber(finalCharacters)) )
            localizacion = localizacion + "/";
        let mURL= localizacion.substring(0, localizacion.lastIndexOf('/'));
        if (location.href !== mURL){
            console.log("distintas: ",location.href, mURL);
            window.history.pushState('object', document.title, mURL);
        }
        
        let contactId = (requiredId === null) ? $(this).attr("value"):requiredId; 
        // let contactId = this.getAttribute("value");

        $(".conversation").css("height", $(".contactsList").height());

        $(".contactsList li").removeClass( "selectedContact");
        // this.classList.add("selectedContact");
        let current = $(`.contactsList li[value=${contactId}]`);
        current.addClass("selectedContact");
        console.log("contactId: ",contactId);
        // let selectedContactNotReadMessages = this.querySelector("span");
        let selectedContactNotReadMessages = current.find("span");
        // console.log(selectedContactNotReadMessages[0]);
        if (selectedContactNotReadMessages[0])
            updateHeaderMessages(false, contactId, null, parseInt(selectedContactNotReadMessages[0].innerText.trim()));
        updateUnread(contactId, true);

        $.ajax(PublicURL + 'comm/getContactInfo', {
            dataType: 'json',
            data: {id: contactId},
            method:'get',
        }).done(function(res){
            let contact = res["user_to_be_found"][0];

            // Asigning the found contact to variable to be used later, in handle incoming
            // selectedContact = res["user_to_be_found"];
            let contactsUnread = res["contacts_unread"];

            [].forEach.call(arrContacts, function(contact) {

                if (contact.querySelectorAll(".unread").length > 0) 
                {
                    let dateInfo = contact.querySelector(".contactInfo .dateInfo");
                    let dni = contact.querySelector(".contactInfo .dni");

                    for (const [key, value] of Object.entries(contactsUnread)){
                        if (dni.textContent == value["dni"]){
                            dateInfo.textContent = value["dateHumanReadable"];
                        } 
                    }
                }
            });
            let fullName = contact.name + " " +contact.lastname;
            $(".conversation .cHeader h4").text(contact ? fullName : 'Select a Contact');

            if (contact){
                let msjs = res["messages_from_user"];

                let str = '<ul>';

                msjs.forEach(function(msj) {
                    if ((msj.user_id_from == contact.id) && (msj.user_id_to == authUser.id)){
                        str += '<li class="ownUser"><div class="text"><span onclick="dropdownDisplay(this)" class="textIcon"><i class="fa fa-sort-down"></i></span><span>'+ msj.message +'</span><p class="dateFeed">'+ msj.date_spa +'</p>';
                        str += '<div class="dropdown-content"><a href="">Reenviar mensaje</a><a href="">Eliminar mensaje</a></div></div></li>'
                    }
                    else if ((msj.user_id_from == authUser.id) && (msj.user_id_to == contact.id)){
                        str += '<li class="alienUser"><div class="text"><span onclick="dropdownDisplay(this)" class="textIcon"><i class="fa fa-sort-down"></i></span><span>'+ msj.message +'</span><p class="dateFeed">'+ msj.date_spa +'</p>';
                        str += '<div class="dropdown-content"><a href="">Reenviar mensaje</a><a href="javascript:void(0)" data-delete-message-id=' + msj.id + '>Eliminar mensaje</a></div></div></li>'
                                                
                        // str += '<li class="alienUser"><div class="text"><span class="textIcon"><i class="fa fa-sort-down"></i></span><span>'+ msj.message +'</span><p class="dateFeed">'+ msj.date_spa +'</p></div></li>';
                        // str += '<li class="alienUser"><div class="text">'+ msj.message + '</div><p>'+msj.date_spa +'</p></li>';
                    }
                    else{
                    //Error
                    console.error("User message id not found or incorrect");
                    }
                }); 

                str += '</ul>';
                // document.getElementById("cMessagesFeed").innerHTML = str;
                $(".cMessagesFeed").html(str);

                $("a[data-delete-message-id]").click(function(e){
                    console.log(e);
                    e.preventDefault();
                    let id = $(this).data("delete-message-id");
                    $.ajax(PublicURL + 'comm/deleteMessageChat', {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, 
                        dataType: 'json',
                        data: {id: id, _method:'delete'},
                        method:'post',
                    }).done(function(res){
                        if (res.status == 0){
                            console.log(res);
                        }
                    })
                    .fail(function(xhr, st, err) {
                        // this.url
                        console.error("error in comm/deleteMessageChat " + xhr, st, err);
                    }); 
                }
                );
            }
            

            $(".cMessageComposer textarea").prop( "disabled", false );
            $(".cMessageComposer textarea").css("display", "block");
            $(".cMessageComposer textarea").focus();

            // var str = window.getComputedStyle($('.cMessagesFeed')[0], ':before').getPropertyValue('bottom');
            // console.log("str",str);
            // document.styleSheets[0].addRule('div.cMessagesFeed:before', 'bottom: 0 "'  + '";');


            // $(".cMessagesFeed").css("max-height", "64vh");
            $(".cMessagesFeed").css("max-height", "69vh");
            $(".cMessagesFeed").removeClass( "selectAContact" );
            $( ".cMessagesFeed" ).hover(function() {
                $( this ).css({"overflow-x": "hidden", "overflow-y": "auto", "scroll-snap-type": "y mandatory"});
            }, function(){
                $(this).css({"overflow": "hidden", "overflow-y": "hidden"});
            })

            $(".cMessagesFeed").addClass("scroller");                     
            $('.cMessageComposer').data('recipient-id', contact.id);
            
        })
        .fail(function(xhr, st, err) {
            console.error("error in comm/getContactInfo " + xhr, st, err);
        }); 
    }

    arrContacts.forEach((c) => { c.addEventListener('click', handleContactClick);})    


    $(".cMessageComposer").keydown(function(event){
        if(event.key === 'Enter') {
            event.preventDefault();
            let writtenMessage = $(".cMessageComposer textarea");
            // console.log("selectedUserId", $(this).data('recipient-id'));

            sendMessage(writtenMessage, $(this).data('recipient-id'), authUser.id, chatChannel);
        }
    });
       
    // Watcher. Scroll when there's a change in the messages feed. Watcher for contacts and for messages.
    // Call when clicked on  a contact. It'll also be called when a new message is created
    $('.cMessagesFeed, .contactsList').bind('DOMSubtreeModified', function(e) {
        if (e.target.innerHTML.length > 0) {
            scrollToBottom(".cMessagesFeed");
        }
    });

    let prevHeight = $('.contactsList').height();
    $('.contactsList').attrchange({
        callback: function (e) {
            let currentHeight = $(this).height();            
            if (prevHeight !== currentHeight) {
            //    console.log('height changed from ' + prevHeight + ' to ' + currentHeight);
                $(".conversation").css("height", currentHeight);
                scrollToBottom(".cMessagesFeed");
                prevHeight = currentHeight;
            }            
        }
    });

    // Closing dropdown messages menus if open 
    window.onclick = function(event) {
        if (!event.target.matches('.fa-sort-down')) {
            let dropdowns = document.getElementsByClassName("dropdown-content");
            let i;
            for (i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                openDropdown.style.display="none";
            }
        }
    }

}
