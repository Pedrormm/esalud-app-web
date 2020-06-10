let width = $(window).width();
if (width < 768) {
    $('.contactsList li').click(function(e) {
        location.assign(PublicURL+"comm/viewMessagesFrom"+"/"+$(this).val());
    });
} 
else {

    let selectedContact = null;
    
    $(".cMessageComposer textarea").prop( "disabled", true );
    $(".cMessageComposer textarea").css("display", "none");

    const arrContacts = Array.from(document.querySelectorAll('.contactsList li'));

    function handleContactClick() {
        $(".contactsList li").removeClass( "selectedContact");
        this.classList.add("selectedContact");
        let contactId = this.getAttribute("value"); 
        $.ajax(PublicURL + 'comm/getContactInfo', {
            dataType: 'json',
            data: {id: contactId},
            method:'get',
        }).done(function(res){

            // Asigning the found contact to variable to be used later, in handle incoming
            // selectedContact = res["user_to_be_found"];

        //  messages = res["messages_from_user"];
            
            let fullName = res["user_to_be_found"][0].name + " " +res["user_to_be_found"][0].lastname;
            $(".conversation .cHeader h4").text(res["user_to_be_found"][0] ? fullName : 'Select a Contact');

            if (res["user_to_be_found"][0]){
            let msjs = res["messages_from_user"];

            let str = '<ul>';

            msjs.forEach(function(msj) {
                if ((msj.user_id_from == res["user_to_be_found"][0].id) && (msj.user_id_to == authUser.id)){
                str += '<li class="ownUser"><div class="text">'+ msj.message + '</div></li>';
                }
                else if ((msj.user_id_from == authUser.id) && (msj.user_id_to == res["user_to_be_found"][0].id)){
                str += '<li class="alienUser"><div class="text">'+ msj.message + '</div></li>';
                }
                else{
                //Error
                console.error("User message id not found or incorrect");
                }

            }); 

            str += '</ul>';
            // document.getElementById("cMessagesFeed").innerHTML = str;
            $(".cMessagesFeed").html(str);
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

            $(".cMessageComposer").keydown(function(event){
            if(event.key === 'Enter') {
                event.preventDefault();
                sendMessage();
            }
            });
            
        })
        .fail(function(xhr, st, err) {
            console.error("error in comm/getContactInfo " + xhr, st, err);
        }); 
    }

    arrContacts.forEach((c) => { c.addEventListener('click', handleContactClick);})       
    // Watcher. Scroll when there's a change in the messages feed. Watcher for contacts and for messages.
    // Call when clicked on  a contact. It'll also be called when a new message is created
    $('.cMessagesFeed, .contactsList').bind('DOMSubtreeModified', function(e) {
        if (e.target.innerHTML.length > 0) {
            scrollToBottom(".cMessagesFeed");
        }
    });

}
