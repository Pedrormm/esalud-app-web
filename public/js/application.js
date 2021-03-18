
var _avoidAllSendings = false;

document.addEventListener("click", function(){
    assignHeadersToRowsResponsive();
    $("#mediaTableCss").attr('href', PublicURL + "css/media-table.css");

    $(document).ajaxComplete(function(){
        $("#mediaTableCss").attr("href", PublicURL + "css/roleEdit.css");
    });

    if (isABootstrapModalOpen()){
        // $("#mediaTableCss").remove();
        $("#mediaTableCss").attr("href", PublicURL + "css/roleEdit.css");
    }

  });

$(document).on( 'draw.dt', function ( e, settings ) {
    assignHeadersToRowsResponsive();
} );

  
$(function() {

    if ($('#dataTable').length > 0 ){
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
        });
    }
    // assignHeadersToRowsResponsive();
    // $(".sidebar").toggleClass("toggled");
    /*console.log("click on sidebartoggletop");
    $('#sidebarToggleTop').click();
    console.log("clicked");*/

    
var pusher = videoPusherInit();
var videoChannel = pusher[1];

videoChannel.bind(`client-video-channel-send`, (data) => {
    console.log("Recibido datos video channel", data);
    if (data.userReceiverId == authUser.id){

            showModalConfirm("Llamada entrante de "+data.userReceiverFullName,"¿Desea aceptar la llamada?",()=>{
            var hiddenForm = $('<form>', {id: 'videoFormData', method: 'post', action: PublicURL+'user/video-call-container', target: 'videoWindow'});
            hiddenForm.append($('<input>', {type: 'hidden', name:'userFullName', value: authUser.name + " " + authUser.lastname}));
            hiddenForm.append($('<input>', {type: 'hidden', name:'sessionName', value: data.session}));
            $('body').append(hiddenForm);
    
            window.open('', 'videoWindow');
            $('#videoFormData').submit(); 
        },()=>{
            
        });
    }

});



});//#TAG: #onload-jquery

// let PublicURL= location.href.substring(0, location.href.includes('.test')? location.href.indexOf('.test')+6 : 
//  location.href.includes('public') ? location.href.indexOf('public')+7:console.log("Url not found"));

// let PublicURL = location.href.includes('public') ? location.href.indexOf('public')+7:
// location.href.match(/^http(s)?:\/\/([^\/\$]+)/);

// if (!location.href.includes('public')){
//     PublicURL = PublicURL[0] + "/";
// }

var PublicURL = location.href.includes('public') ? location.href.substring(0, location.href.indexOf('public')+7):
location.href.match(/^(http(s)?:\/\/([^\/$]+))/);

if (!location.href.includes('public')){
    // PublicURL = PublicURL[0].replace(/(.+)[^\/]$/, "$1/");
    PublicURL = PublicURL[0].lastIndexOf("/") !== PublicURL[0].length - 1 ? (PublicURL[0] + "/") : PublicURL[0] ;
}

// "http://asoghaoggaho/".replace(/(.+)[^\/]$/, "$1/") 

// "https://1.1.1.1/hospital/".match(/^(http(s)?:\/\/([^\/$]+))/)

//


console.log("**PUBLICURL ", PublicURL);

Date.prototype.today = function () { 
    return ((this.getDate() < 10)?"0":"") + this.getDate() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ this.getFullYear();
}

Date.prototype.timeNow = function () {
     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
}
 
var roleId;

function asyncCall(endpoint, jQselector, displayErrorOnLayer, forceDisplay) {
    
    console.log("Calling asyncCall with args", arguments);
    if(typeof displayErrorOnLayer != 'boolean')
        displayErrorOnLayer = false;
    if(typeof forceDisplay != 'boolean')
        forceDisplay = true;
    $.ajax(PublicURL + endpoint, {
        method:'get',
        dataType:'html',
        async:true,
    }).done(function(res, st, xhr) {

        //console.log("success arguments", arguments);
        if($(jQselector).length) {
            $(jQselector).html(res);
            if(forceDisplay)
                $(jQselector).show();
        }
        else {
            console.warn("Destiantion layer", jQselector, "not found");
        }
    }).fail(function(xhr, status, error) {
        console.error("fail arguments", arguments);
       
        // if(displayErrorOnLayer) {
           
        //     $(jQselector).html('<div class="alert alert-danger">ERROR: No se pudo cargar contenido en destino</div>');
        // }
    });
}

function saveModalActionAjax(url, data={}, method='PUT', type='json', callbackOkFunction=function(){}, closeModal=true) {

    var funcName = "saveModalActionAjax";
    // console.log("datos: ",data);

        if(closeModal) {
            callbackOkFunction = (function() {
                let cachedFunction = callbackOkFunction;
                return function() {
                    cachedFunction.apply(this, arguments); // use .apply() to call itself
                    $('#generic-modal').modal('hide');
                };
            })();
        }
       
        $.ajax(url,
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },  
                dataType: type,
                method: method,
                data: data
            }
        ).done(callbackOkFunction)
        .fail(function(xhr, st, err) {
            showInlineError("Error en llamada " + funcName + ": " + err);
            console.error("error in " + funcName, xhr, st, err);
            $('#generic-modal').modal('hide');
        });
        $('#saveModal').off();
   
}
/**
 * Show an inline message in #error-conatiner container
 * @author Pedro 
 * @param int|string status 
 * @param string message 
 * @param int timeout 0 for no disappear, >0 seconds to disappear
 */
function showInlineError(status,message, timeout=0, modal=false) {
    let containerNameError = '#error-container';
    if (modal){
        containerNameError = '#error-container-modal';
    }
    $(containerNameError).show().text(message);
    if(timeout>0) {
        setTimeout(function() {
            $(containerNameError).hide(500);
        }, timeout*1000);
    }

}
/**
 * Show an inline message in #message-conatiner container
 * @author Pedro 
 * @param string message 
 * @param int timeout 0 for no disappear, >0 seconds to disappear
 */
function showInlineMessage(message, timeout=0) {
    $('#message-container').show().html(message);
  
    if(timeout>0) {
        setTimeout(function() {
            $('#message-container').hide(500);
        }, timeout*1000);
    }
}
function showModal(title, body, htmlFormat, url = null, size=null, drageable=false, collapseable=false, 
     removeApp=false, secondstoCancel=null, callbackOkButton = null, nameCancelModal="Close", nameSaveModal="Save changes") {
    $('#generic-modal .modal-body').text('');
    $('#generic-modal .modal-title').text(title);
    if (size){
        $('.modal-dialog').addClass(size);
    }

    if (nameCancelModal){
        $('#generic-modal #closeModal').text(nameCancelModal);
    }

    if (nameSaveModal){
        $('#generic-modal #saveModal').text(nameSaveModal);
    }

    if(typeof callbackOkButton == 'function') {
        callbackOkButton = (function() {
            let cachedFunction = callbackOkButton;
            return function(e) {
                cachedFunction.apply(this, arguments);
                if(!_avoidAllSendings)
                    $('#generic-modal').modal('hide');
                $( this ).off( e ); 
            }
        })();
        $('#generic-modal #saveModal').click(callbackOkButton);
    }

    if (drageable){
        dragElement($('#generic-modal')[0]);
        $('.modal-header').attr('style', 'cursor: all-scroll !important');
    }

    if (collapseable){
        $('.modalCollapse').show();
        $(".modal-body").collapse('show');
    }
   
    if(htmlFormat)
        $('#generic-modal .modal-body').html(body);
    else if (url) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: url,

        }).done(function(res) {
            $('#generic-modal .modal-body').html(res);
        });
        // $('#generic-modal').modal('show').find('.modal-body').load(url);
        //$('#generic-modal .modal-body').load(url);
        //$('#generic-modal .modal-body').html(url);
        // $('#generic-modal').modal('show');

    }
    else{
        $('#generic-modal .modal-body').text(body);
    }

    if ($.isNumeric(secondstoCancel)){
        let seconds = secondstoCancel;
        //Esto inicializa el boton close del modal con los segundos a descontar
        let cont = (function(displaySeconds){
            // Si no existia lo creo, sino lo actualizo
            if(!$('#count').length) {
                $("div.modal-footer button[data-dismiss='modal'].btn-secondary").append(
                    $('<span />').attr('id', 'count').addClass("font-weight-bold").text(' ['+displaySeconds+']')
                );
            }
            else {
                $('#count').text(' [' + displaySeconds + ']');
            }
        });
        function refreshCountdown() {
            // console.log("refreshCountdown con", seconds, "segudnos");
            seconds--;
            $("#count").text(" ["+seconds+"]");
            if (seconds <= 0){
                clearInterval(countdown);
                console.log("Se destruye el intevalo countdown");
            } 
        }
        cont(secondstoCancel);

        //let seconds = $("#count").text().replace(/\[|\]/g,'');
        console.log("Seconds to disable: " + seconds);
        // Esto actualiza el contador visual del boton close
        let countdown = setInterval(refreshCountdown, 1000);

        let moveTimer;

        $("#generic-modal").on("mouseout",function(){
            clearTimeout(moveTimer);
        });

        $("#generic-modal").on("mousemove keypress",function(){
            // console.log("I'm moving");
            cont(secondstoCancel);
            seconds = secondstoCancel;
            //countdown = setInterval(refreshCountdown);
            clearTimeout(moveTimer);

            moveTimer = setTimeout(function(){
                // console.log("I stopped moving");
                $("#generic-modal").fadeTo(800, 0).slideUp(800, function(){
                    $(this).modal('hide'); 
                });
                $("#generic-modal").stop().off();
            },secondstoCancel*1000)
        });
    }
    else{
        $("#count").remove();
    }

    $('#generic-modal').modal({
        backdrop: 'static',
        keyboard: false
    });

    $(".modalCollapse").click(function(){
        $('.modal-body').collapse('toggle');
        let icon = this.querySelector('i');

        $('.modal-body').on('hidden.bs.collapse', function () {
            icon.classList.remove('fa-caret-square-down');
            icon.classList.add('fa-caret-square-right');
        });
        $('.modal-body').on('shown.bs.collapse', function () {
            icon.classList.remove('fa-caret-square-right');
            icon.classList.add('fa-caret-square-down');
        }); 
    
        return;

    });
    if (removeApp == true){
        $('#app').remove();
    }


}//--fin showModal


function showModalConfirm(title="Title", message="No message", callback=function(){},callbackClose=function(){}, optConfirmText="Ok",
secondsToCancel=null, avoidClose=true) {
    let mainId = '#confirm-modal';
    let buttonOkId = '#okConfirmModal';
    let buttonCloseId = '#closeModalConfirm';
    $(mainId + ' .modal-title').text(title);
    $(mainId + ' .modal-body').text(message);
    callback = (function() {
        let cachedFunction = callback;
        return function() {
            cachedFunction.apply(this, arguments);
            $(mainId).modal('hide');
        }
    })();

    $(mainId).modal({
        backdrop: 'static',
        keyboard: false
    });

    callbackClose = (function() {
        let cachedFunction = callbackClose;
        return function() {
            cachedFunction.apply(this, arguments);
        }
    })();

    $(buttonOkId).click(callback);

    $(buttonCloseId).click(callbackClose);
    
    if(optConfirmText !== undefined) {
        $(buttonOkId).text(optConfirmText);
    }
    $(mainId).modal('show');
}//--fin showModalConfirm


function getAge(dateString) {
    let today = new Date();
    let birthDate = new Date(dateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    let m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
  }

function dragElement(elmnt) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    } else {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

// $('#element').donetyping(callback[, timeout=5000])
// Fires callback when a user has finished typing. This is determined by the time elapsed
// since the last keystroke and timeout parameter or the blur event--whichever comes first.
//   @callback: function to be called when even triggers
//   @timeout:  (default=2000) timeout, in ms, to to wait before triggering event if not
//              caused by blur.
;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 2e3; // 2 seconds default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    
                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

function patternCase(str, pattern=/(?: )+/, allCase=false, spellCheck=true, charLimit=2) {
    // Via Regex. Allowing multiple separators 
    let splitStr = str.toLowerCase().split(pattern);
    
        for (let i = 0; i < splitStr.length; i++) {
            // console.log('Original: ', splitStr[i]);
            if (spellCheck){
                let array_of_suggestions = dictionary.suggest(splitStr[i]);
                // console.log(array_of_suggestions, array_of_suggestions[0]);
                if (array_of_suggestions && array_of_suggestions.length) {   
                    splitStr[i] = array_of_suggestions[0];
                }
            }
            // console.log('Palabra: ', splitStr[i]);
            let caseCondition = allCase ? (splitStr[i].length > charLimit || i == 0) : (i == 0);
            if (caseCondition){
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }           
        }

    return splitStr.join(' '); 
}

function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
      currentDate = Date.now();
    } while (currentDate - date < milliseconds);
  }

function isABootstrapModalOpen() {
    return $('.modal.show').length >0;
    // return true;
}

function isInVideoCallView() {
    return window.location.href != (URL+'user/video-call');
}

function sendMessage(writtenMessage, userToMessageId=null, idSender=null, channel=null ) {
    let msj = writtenMessage.val();
    if (msj && (msj != "")){
        

        $.ajax(PublicURL + 'comm/send', {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },  
            dataType: 'json',
            data: {contact_id: userToMessageId, msj: msj},
            method:'post',
        }).done(function(res){

            channel.trigger(`client-send`, { 
                idSender: idSender,
                idReceiver: userToMessageId,
                user_id_from: idSender,
                user_id_to: userToMessageId,
                message: msj,
                date_spa: res.date_spa,
                date_eng: res.date_eng,
            });
            // We push the new message into the messages array cause we already have the other messages locally
            // We add the msj to the parent
            console.log("res: ",res);
            saveNewMessage(res, true);
        })
        .fail(function(xhr, st, err) {
            console.error("error in comm/send " + xhr, st, err);
        }); 

        writtenMessage.val('');     
    }
}

function saveNewMessage(messageObj, alienUser=false, contactToWriteId=null) {
    let appended = false;
    let oldLength = $(".cMessagesFeed li").length;
    let currentDate = new Date().today() + " " + new Date().timeNow();

    console.log("messageSave",messageObj.message, currentDate);
    console.log("Yo soy", authUser.id, "message es ", messageObj, " alien es ", alienUser);
    // We just have to append the message after the last li, with the proper class
    let idFrom = authUser.id;
    let idTo = messageObj.user_id_from;
    if(alienUser) {
        idFrom = authUser.id;
        idTo = messageObj.user_id_to;
    }
   
    let str = generateMessageLine(messageObj, idFrom, idTo);

    $('.cMessagesFeed ul').append(str);
    if($(".cMessagesFeed li").length > oldLength)
        appended = true;

    if (appended==false)    
        updateHeaderMessages(true, contactToWriteId, messageObj.message);
        
    return appended;
}

function scrollToBottom(element, speed=10) {
    setTimeout(function() {
        $(element).animate({ scrollTop: $(document).height() }, speed);

        let docHeight = getDocHeight();
        let scrollHeight = $(window).scrollTop() + $(window).height();

        setTimeout(function() {            
            if (docHeight !== scrollHeight){
                // console.log("not bottom!");
                let maxValue = Number.MAX_SAFE_INTEGER;
                let bigInt = BigInt(Math.pow(maxValue,2));   
                $(element).animate({ scrollTop: bigInt }, 'slow');
            }
        }, 50);
    }, 50);
}

function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}

function chatPusherInit() {
    Pusher.logToConsole = false;

    console.log("antes", PublicURL);

    let chatPusher = new Pusher("9e2cbb3bb69dab826cef", {
        authEndpoint: PublicURL+'pusher/auth',
        cluster: 'ap2',
        encrypted: true,
        auth: { 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            params: authUser.id,
            // params: {
            //     socket_id: authUser.id,
            //     channel_name: 'name1'
            // },
        }
    });
    console.log("despues: ", PublicURL+'pusher/auth');
    
    chatPusher.connection.bind( 'error', function( err ) {
        console.log("Pusher chat error: ",err);
    });
    
    let chatChannel = chatPusher.subscribe('presence-chat-channel');
    return [chatPusher, chatChannel];
}

function videoPusherInit() {
    Pusher.logToConsole = false;

    let videoPusher = new Pusher("9e2cbb3bb69dab826cef", {
        authEndpoint: PublicURL+'pusher/auth',
        cluster: 'ap2',
        encrypted: true,
        auth: { 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            // params: authUser.id,
        }
    });
    
    videoPusher.connection.bind( 'error', function( err ) {
        console.log("Pusher video session error: ",err);
    });
    
    let videoChannel = videoPusher.subscribe('presence-video-session-channel');
    return [videoPusher, videoChannel];
}

function updateHeaderMessages(add=false, contactToWriteId, message, msjRead=0) {
    let icon = $('#numMessagesHeader');
    let num = icon.text();
    
    let top = $("#top-navigator-messages a[data-contact-id="+ contactToWriteId +"]") 

    if(add){
        if (num && (num>0) ) 
            icon.text(parseInt(num)+1);
        else
            icon.text(1);

        if (top[0]){
            let nod = top.find('.text-truncate').html(message);
            nod.parent().addClass( "font-weight-bold" );
            top.find('.headerDate').html("Recently");
            console.log("top ",nod.parent()[0],top[0], nod[0]);
    
            let unread = top.find('.unread');
            if (unread[0]){
                unread.text(parseInt(num)+1);
            }
            else{
                top.append(
                    $('<div />').addClass("mr-3 header-unread").append($('<span />').addClass("unread").text("1"))
                ); 
            }  
        }
        else{
            console.log("No se encuentra en el header");

            // Ajax call to get the userName and avatar from id
            $.ajax(PublicURL + 'comm/getUserFromId', {
                dataType: 'json',
                data: {id: contactToWriteId},
                method:'get',
            }).done(function(res){
                console.log("respuesta",res);
                let whatToInsert =
                ` <a class='dropdown-item d-flex align-items-center' data-contact-id=${contactToWriteId} href='${PublicURL}comm/messaging' >`+
                 "<div class='dropdown-list-image mr-3'>"+
                    `<img class='rounded-circle' src='${(res.avatar) ? PublicURL+"images/avatars/"+res.avatar : ((res.sex == "male") ? PublicURL+"images/avatars/user_man.PNG": (res.sex == "female")? PublicURL+"images/avatars/user_woman.PNG":null) }' alt='Foto de perfil'>`+  
                         "<div class='status-indicator bg-success'></div>"+
                 "</div>"+
                 "<div class='mr-3 font-weight-bold'>"+
                    `<div class='text-truncate'>${message}</div>`+
                    `<div class='small text-gray-500'>${res.name+" "+res.lastname} · <span class='headerDate'>Recently</span>`+
                     "</div>"+
                 "</div>"+
                 "<div class='mr-3 header-unread'></div>"+
                 "<div class='mr-3 header-unread'><span class='unread'>1</span></div></a>";
 
                window.localStorage.setItem("contact-id",contactToWriteId);

                $(whatToInsert).insertAfter('#top-navigator-messages .dropdown-header');

            })
            .fail(function(xhr, st, err) {
                console.error("error in comm/getUserNameFromId " + xhr, st, err);
            }); 

        }
    }
    else{
        icon.text(parseInt(num)-parseInt(msjRead));
        // Check if children of top have font-weight-bold class
        if (top[0]){
            $('.top-message').removeClass('font-weight-bold');
            $('.header-unread .unread').remove();
        }
        else{
            console.log("No ha sido seleccionado");
        }
    }

    if (icon.text() < 1){
        icon.empty();
        $('#numMessagesHeader').removeClass("badge");
    }
    else
        $('#numMessagesHeader').addClass("badge");
}

function isNumber(n) {
     return /^-?[\d.]+(?:e-?\d+)?$/.test(n); 
} 

function settingUpPhone(){
    let input = document.querySelector("#smsPhone");
    let errorMsg = document.querySelector("#error-msg");
    let validMsg = document.querySelector("#valid-msg");

    let errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    let intl = window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function(successful, failure){
            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp){
                let countryCode = (resp && resp.country) ? resp.country : "";
                console.log("codigo", countryCode);
                successful(countryCode);
            });
        },
        utilsScript: PublicURL + "vendor/intl-tel-input-master/js/utils.js"
    });

    let reset = function(){
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
    };
    
    // Validate on blur event
    input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()){
            if (intl.isValidNumber()){
                validMsg.classList.remove("hide");
                $('#valid-msg').html("&#10004; Valid number");
            }
            else{
                $('#valid-msg').text("");
                input.classList.add("error");
                let errorCode = intl.getValidationError();
                let code = errorMap[errorCode];
                if (!code){
                    code = "Not valid";
                }
                errorMsg.innerHTML = code;
                errorMsg.classList.remove("hide");
            }
        }
    });

    // Reset on keyUp change event
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

    $('#smsPhone').on('change', function(e) {
        $(e.target).val($(e.target).val().replace(/[^\d\-]/g, ''))
    });
    $('#smsPhone').on('keypress', function(e) {
        keys = ['0','1','2','3','4','5','6','7','8','9','-']
        return keys.indexOf(event.key) > -1
    });

}

function assignHeadersToRowsResponsive(){
    if (screen.width <= 1024){

        //Assign class to each header
        $('th').each(function() {
            $(this).addClass('header-' + $(this).index());
        });
        //Assign a data-header attribute with the text from the corresponding header
        $('td').each(function() {
            $(this).attr('data-header', $('.header-' + $(this).index()).text());
        });
        // $('#mainCardShadow').removeClass(['card','shadow']);

        // $('#sidebarToggleTop').addClass('toggled');
        // $('#sidebarToggleTop').trigger('click');
        // $(".sidebar").toggleClass("toggled");

        // $("body").toggleClass("sidebar-toggled"); 
        // $(".sidebar").toggleClass("toggled");
        // if ($(".sidebar").hasClass("toggled")) {
        //     console.log("expansion 1024");
        //     $('.sidebar .collapse').collapse('hide');
        // };

    
        
    }
}


