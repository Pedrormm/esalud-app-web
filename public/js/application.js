
document.addEventListener("click", function(){
    assignHeadersToRowsResponsive();
    $("#mediaTableCss").attr('href', _publicUrl + "css/media-table.css");

    $(document).ajaxComplete(function(){
        $("#mediaTableCss").attr("href", _publicUrl + "css/roleEdit.css");
    });

    if (isABootstrapModalOpen()){
        // $("#mediaTableCss").remove();
        $("#mediaTableCss").attr("href", _publicUrl + "css/roleEdit.css");
    }

  });

$(document).on( 'draw.dt', function ( e, settings ) {
    assignHeadersToRowsResponsive();
} );

// On load jquery  
$(function() {
    if ($("#topbar-navheader")[0]){
        $('#topbar-navheader .nav-link,.dropdown-toggle').trigger('click');
    } 
    // selectpicker
    clickOnSelectpicker();

    let flagLanguage = $("#headerTopFlag").data("language");
    switch(flagLanguage){
        case "es":
            $("#headerTopFlag").attr("src",_flagUrl+"es.svg");
            break;
        case "en":
            $("#headerTopFlag").attr("src",_flagUrl+"um.svg");
            break;
        case "it":
            $("#headerTopFlag").attr("src",_flagUrl+"it.svg");
            break;
        case "pt":
            $("#headerTopFlag").attr("src",_flagUrl+"pt.svg");
            break;
        case "fr":
            $("#headerTopFlag").attr("src",_flagUrl+"fr.svg");
            break;
        case "ro":
            $("#headerTopFlag").attr("src",_flagUrl+"ro.svg");
            break;
        case "de":
            $("#headerTopFlag").attr("src",_flagUrl+"de.svg");
            break;
        case "ar":
            $("#headerTopFlag").attr("src",_flagUrl+"sa.svg");
            break;
        case "ru":
            $("#headerTopFlag").attr("src",_flagUrl+"ru.svg");
            break;     
        case "zh_CN":
            $("#headerTopFlag").attr("src",_flagUrl+"cn.svg");
            break;
        case "ja":
            $("#headerTopFlag").attr("src",_flagUrl+"jp.svg");
            break; 
        default:
            $("#headerTopFlag").attr("src",_flagUrl+"es.svg");
            break;
    }
    $("#headerTopFlag").attr("alt",_longLang+" flag");

    $.fn.dataTable.ext.errMode = 'throw';
    if ($('#dataTable').length > 0 ){
        $('#dataTable').DataTable({
            "language": {
                "url": _urlDtLang
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
            var hiddenForm = $('<form>', {id: 'videoFormData', method: 'post', action: _publicUrl+'videoCallContainer', target: 'videoWindow'});
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

/**
 * Fires callback when a user has finished typing. This is determined by the time elapsed
 * since the last keystroke and timeout parameter or the blur event--whichever comes first.
 * $('#element').donetyping(callback[, timeout=5000])
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {function} callback - Function to be called when even triggers.
 * @param {number} [timeout=2000] - Timeout, in ms, to to wait before triggering event if not caused by blur.
 * @return {void} Nothing
 */
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

// Today and timeNow are used for getting the currentDate at the saveNewMessage function
Date.prototype.today = function () { 
    return ((this.getDate() < 10)?"0":"") + this.getDate() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ this.getFullYear();
}

Date.prototype.timeNow = function () {
     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
}
 
// Using jdocs https://jsdoc.app/tags-param.html

/**
 * Displays an ajax function over an html tag (selector)
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} endpoint - The endpoint (url) for the ajax call.
 * @param {Object} jQselector - The selector where the ajax result function will be displayed.
 * @param {boolean} [displayErrorOnLayer=false] - A boolean indicating whether and error 
 * is going to be displayed on the selector target when there is an error or not. It is false by default
 * @param {boolean} [forceDisplay=true] - A boolean indicating whether the selected is going to be forced to be displayed or not
 * It is true by befault.
 * @return {void} Nothing
 */
function asyncCall(endpoint, jQselector, displayErrorOnLayer, forceDisplay) {
    
    // console.log("Calling asyncCall with args", arguments);
    if(typeof displayErrorOnLayer != 'boolean')
        displayErrorOnLayer = false;
    if(typeof forceDisplay != 'boolean')
        forceDisplay = true;
    $.ajax(_publicUrl + endpoint, {
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
            // console.warn("Destiantion layer", jQselector, "not found");
        }
    }).fail(function(xhr, status, error) {
        console.error("fail arguments", arguments);
       
        // if(displayErrorOnLayer) {
           
        //     $(jQselector).html('<div class="alert alert-danger">ERROR: No se pudo cargar contenido en destino</div>');
        // }
    });
}

/**
 * Shows the return of an ajax call inside a bootstrap Modal with Ajax options
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} url - The endpoint (url) for the ajax call.
 * @param {Object} [data={}] - The data for the ajax input.
 * @param {string} [method="PUT"] - The data used for the ajax call
 * @param {string} [type="json"] - The dataType of the ajax call
 * @param {function} [callbackOkFunction=function(){}] - Callback function when the user pressed "ok" 
 * and the function went ok.
 * @param {boolean} [closeModal=true] - A boolean indicating whether the modal will be hide 
 * when the callbak function is applied or not. It is true by befault.
 * @return {void} Nothing
 */
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
 * Shows an inline error message in #error-conatiner container
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {number|string} status - The status of the response. 0 for ok | 1 for error
 * @param {string} message - The message to be displayed on the container
 * @param {number} [timeout=0] - 0 for no disappearing | >0 for seconds to disappear
 * @return {void} Nothing
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
 * Shows an inline success message in #message-conatiner container
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} message - The message to be displayed on the container
 * @param {number} [timeout=0] - 0 for no disappearing | >0 for seconds to disappear
 * @return {void} Nothing
 */
function showInlineMessage(message, timeout=0) {
    $('#message-container').show().html(message);
  
    if(timeout>0) {
        setTimeout(function() {
            $('#message-container').hide(500);
        }, timeout*1000);
    }
}

/**
 * Shows the return of an ajax call inside a bootstrap Modal with multiple options
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} title - The title of the bootstrap modal to be displayed.
 * @param {Object} body - The body of the bootstrap modal in case there is no ajax. 
 * If there is an ajax call, its response will be overlaped.
 * @param {boolean} htmlFormat - If it is empty, the bootstrap body will have an ajax response.
 * If it is not empty, the bootstrap body will have whatever was passed in the previous argument (body).
 * @param {string} [url=null] - The endpoint (url) for the ajax call.
 * @param {string} [size=null] - The size of the bootstrap modal.
 * All the posible sizes are descripted at https://getbootstrap.com/docs/4.2/components/modal/
 * @param {boolean} [drageable=false] - A boolean indicating whether the modal will be drageable
 * (meaning that it can be moved) or not. If it is drageable the function dragElement will make it possible.
 * @param {boolean} [collapseable=false] - A boolean indicating whether the modal will be collapseable
 * (meaning that it can be collapsed in a single line) or not. 
 * @param {boolean} [removeApp=false] - A boolean indicating whether #app 
 * (the videoCall id that will be rendered on React) will be removed or not.
 * @param {number} [secondstoCancel=null] - null: The modal does not cancel on its own.
 * Any number: Shows the quantity of seconds for the modal to be canceled.
 * @param {function} [callbackOkFunction=function(){}] - Callback function when the user pressed "ok" 
 * and the function went ok.
 * @param {string} [nameCancelModal="Close"] - null: The cancel button will have the default string value (Close).
 * Any string: The modal cancel button will have the given string.
 * @param {string} [nameSaveModal="Save changes"] - null: The save button will have the default string value (Save changes).
 * Any string: The modal save button will have the given string.
 * @return {void} Nothing
 */
function showModal(title, body, htmlFormat, url = null, size=null, drageable=false, collapseable=false, 
     removeApp=false, secondstoCancel=null, callbackOkButton = null, nameCancelModal=_messagesLocalization.close_stat, nameSaveModal=_messagesLocalization.save_changes) {
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


}//--end showModal

/**
 * Shows a bootstrap modal with a message and two possible callback functions 
 * (for when it has been closed and for when it is click on "save" and it works out ok)
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} title - The title of the bootstrap modal to be displayed.
 * @param {Object} message - The message to be displayed on the bootstrap body
 * @param {function} [callback=function(){}] - Callback function when the user pressed "ok" 
 * or whatever the argument optConfirmText has.
 * @param {function} [callbackClose=function(){}] - Callback function when the user pressed "cancel" 
 * @param {string} [optConfirmText="Ok"] - The save button (or ok, confirm button) will have the given string.
 * @return {void} Nothing
 */
function showModalConfirm(title=_messagesLocalization.title_stat, message=_messagesLocalization.no_response_message, callback=function(){},callbackClose=function(){}, optConfirmText=_messagesLocalization.ok_stat) {
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
}//--end showModalConfirm

/**
 * Returns the age of a person in years when a date is given
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {date} dateString - The date given.
 * @return {number} - The age of the person in years.
 */
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

/**
 * Moves dynamically thoughout the window the given element
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} elmnt - The element to be moved.
 * @return {void} Nothing
 */
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

/**
 * Returns the closest phrase (or rather, the most similar) in the dictionary of the given one,
 * and changes the first letter of each word to uppercase when each word is larger than the charLimit given
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} str - The given phrase
 * @param {Object} pattern - The reggex value, in case multiple separators will be allowed
 * @param {boolean} [allCase=false] - A boolean indicating whether all the resulting 
 * characters will be uppercase or not.
 * @param {spellCheck} [allCase=true] - A boolean indicating whether the spelling 
 * (and thus, changing the resulting word accordingly) will be taken into account or not.
 * @param {number} [charLimit=2] - The number of characters for each word to be taken into account
 * for being modified.
 * @return {string} - The resulting phrase
 */
function patternCase(str, pattern=/(?: )+/, allCase=false, spellCheck=true, charLimit=2) {
    // Via Regex. Allowing multiple separators 
    let splitStr = str.toLowerCase().split(pattern);
    
        for (let i = 0; i < splitStr.length; i++) {
            // console.log('Original: ', splitStr[i]);
            if (spellCheck){
                if (_dictionary){
                    let array_of_suggestions = _dictionary.suggest(splitStr[i]);
                    // console.log(array_of_suggestions, array_of_suggestions[0]);
                    if (array_of_suggestions && array_of_suggestions.length) {   
                        splitStr[i] = array_of_suggestions[0];
                    }
                }
                else{
                    splitStr[i]="";
                }
            }
            // console.log('Word: ', splitStr[i]);
            let caseCondition = allCase ? (splitStr[i].length > charLimit || i == 0) : (i == 0);
            if (caseCondition){
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }           
        }

    return splitStr.join(' '); 
}

/**
 * Sleeps everything for the time given
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {number} milliseconds - The time for the app to be slept, in ms
 * @return {void} Nothing
 */
function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
      currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

/**
 * Returns whether a bootstrap modal is currently open or not 
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {boolean} - If the modal is opened or not
 */
function isABootstrapModalOpen() {
    return $('.modal.show').length >0;
}

/**
 * Returns whether the view the user is in is the videoCall one or not
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {boolean} - If we are located in the videoCall view or not
 */
function isInVideoCallView() {
    return window.location.href != (URL+'videoCall');
}

/**
 * Creates a pusher trigger with the sent appointment
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} [appointment=null] - The given appointment object.
 * @param {Object} [channel=null] - Channel where the pusher trigger will occur.
 * @return {void} Nothing
 */
function sendAlert(appointment=null,channel=null ) {
    if (appointment){
        
        $.ajax(_publicUrl + 'messaging/send', {
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
            console.error("error in messaging/send " + xhr, st, err);
        }); 

        writtenMessage.val('');     
    }
}

/**
 * Creates a pusher trigger with the sent message
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} writtenMessage - The given message to be sent.
 * @param {number} [userToMessageId=null] - Id of the user who recieves the mesage.
 * @param {number} [idSender=null] - Id of the user who sends the mesage.
 * @param {Object} [channel=null] - Channel where the pusher trigger will occur.
 * @return {void} Nothing
 */
function sendMessage(writtenMessage, userToMessageId=null, idSender=null, channel=null ) {
    let msj = writtenMessage.val();
    if (msj && (msj != "")){
        
        $.ajax(_publicUrl + 'messaging/send', {
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
            console.error("error in messaging/send " + xhr, st, err);
        }); 

        writtenMessage.val('');     
    }
}

/**
 * Saves the given message updating it in the messages feed and in the header
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} messageObj - The message object to be saved.
 * @param {number} [alienUser=false] - If true, the user who sends the message is the logged user
 * @param {number} [contactToWriteId=null] - Id of the user where the message will be written.
 * @return {void} Nothing
 */
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

/**
 * Scrolls the given element to the bottom of the screen at a given speed
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} element - Element that will be scrolled to the bottom.
 * @param {number} [speed=10] - Speed, in ms, at which the animation will occur.
 * @return {void} Nothing
 */
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

/**
 * Returns the height of the current view
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {number} The height of the document (view)
 */
function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}

/**
 * Initializes an element in pusher and subscribes to a pressence channel
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {boolean} [isChat=true] - If it is a chat the channel name is swaped.
 * @return {void} Nothing
 */
function chatPusherInit(isChat = true) {
    console.log("llamada chatPusherInit",chatPusherInit.caller);
    Pusher.logToConsole = false;

    // console.log("antes", _publicUrl);

    let chatPusher = new Pusher("9e2cbb3bb69dab826cef", {
        authEndpoint: _publicUrl+'pusher/auth',
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
    // console.log("despues: ", _publicUrl+'pusher/auth');
    
    chatPusher.connection.bind( 'error', function( err ) {
        console.log("Pusher chat error: ",err);
    });
    let channelName ="";
    if (isChat){
        channelName='presence-chat-channel';
    }
    else{
        channelName='presence-alert-channel';
    }
    let chatChannel = chatPusher.subscribe(channelName);
    return [chatPusher, chatChannel];
}

/**
 * Initializes an element in pusher and subscribes to a channel
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {void} Nothing
 */
function videoPusherInit() {
    Pusher.logToConsole = false;

    let videoPusher = new Pusher("9e2cbb3bb69dab826cef", {
        authEndpoint: _publicUrl+'pusher/auth',
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

/**
 * Updates the number in the header top bar messages icon and he messages below
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {boolean} [add=true] - If true, the messages icon will be updating with the previous messages number+1
 * @param {number} contactToWriteId - The reciever user id (the one who the message is aimed to).
 * @param {string} message - The message to be updated
 * @param {number} msjRead - The number of messages that the logged user has read
 * @return {void} Nothing
 */
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
            $.ajax(_publicUrl + 'messaging/getUserFromId', {
                dataType: 'json',
                data: {id: contactToWriteId},
                method:'get',
            }).done(function(res){
                let route = _publicUrl+"images/avatars/"+res.avatar;
                let whatToInsert =
                ` <a class='dropdown-item d-flex align-items-center' data-contact-id=${contactToWriteId} href='${_publicUrl}messaging' >`+
                 "<div class='dropdown-list-image mr-3'>"+
                    `<img class='rounded-circle' src='${res.avatar ? route: 
                        ((res.sex == "male") ? _publicUrl+"images/avatars/user_man.png":
                         (res.sex == "female")? _publicUrl+"images/avatars/user_woman.png":null)}' alt='Foto de perfil'>`+  
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
                console.error("error in messaging/getUserFromId " + xhr, st, err);
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
/**
 * Returns wheather the given object is a number or not
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {number} n - The object to be checked.
 * @return {boolean} - Boolean indicating if the object is a number or not
 */
function isNumber(n) {
     return /^-?[\d.]+(?:e-?\d+)?$/.test(n); 
} 

/**
 * Validates the phone number and settings for every country
 * Function made thanks to the International Telephone Input script, https://intl-tel-input.com/
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {void} Nothing
 */
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
        utilsScript: _publicUrl + "vendor/intl-tel-input-master/js/utils.js"
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

/**
 * Makes every table in the app responsive by changing the ths and tds to make it look better and to fit in the device
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {void} Nothing
 */
function assignHeadersToRowsResponsive(){
    // if (screen.width <= 1024){
    if (isMobile()){

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

/**
 * Disables a default setting in the datatables plug-in, 
 * so searchs will not be available till a number of min characters given are written
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {Object} dtSelector - The table jquery selector.
 * @param {number} minChars - The number of characters at minimum needed for the search option to be activated.
 * @param {boolean} [bloodOption=true] - If true, the option searched is blood, 
 * so the minimum characters will change accordingly.
 * @return {void} Nothing
 */
function disableDataTablesMinCharactersSearch(dtSelector, minChars, bloodOption=null) {
    $('.dataTables_filter input')
        .off()
        .on('keyup', function () {
            console.log("Search str length", this.value.length);
            console.log("Search str value", this.value);

            if (bloodOption){
                if(/^(A|B|AB|0)[+-]$/i.test(this.value)){
                    // console.log("es sangre");
                    $(dtSelector).DataTable().search(this.value.trim(), false, false).draw();
                    return false;
                }    
            }
            if(!this.value.length) { 
                $(dtSelector).DataTable().search(this.value.trim(), false, false).draw();
                $(dtSelector).DataTable().ajax.reload();
                return false;
            }
            if (this.value.length < minChars)
                return false;
            $(dtSelector).DataTable().search(this.value.trim(), false, false).draw();
        });
}

/**
 * Returns wheather the device is a mobile phone or not
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @return {boolean} - Boolean indicating if the user is on a phone or not
 */
function isMobile(){
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        return true
    }
    else{
        return false
    }
} 

function clickOnSelectpicker(){
    if ($(".selectpicker")[0]){
        setTimeout(function() {
            $('button.dropdown-toggle').trigger('click');
            $('body').trigger('click');
        }, 1000);
    } 
}

/**
 * Returns the date in the selected language format
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {date} date - The given date.
 * @return {string} - The date properly formatted with the language
 */

function getLanguageDate(date){
    let mydate = new Date(date);
    let publishedDate;
    
    switch(_lang){
      case "es":
        publishedDate = new Intl.DateTimeFormat('es-ES', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "en":
        publishedDate = new Intl.DateTimeFormat('en-GB', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "it":
        publishedDate = new Intl.DateTimeFormat('it-IT', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "pt":
        publishedDate = new Intl.DateTimeFormat('pt-PT', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "fr":
        publishedDate = new Intl.DateTimeFormat('fr-FR', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "ro":
        publishedDate = new Intl.DateTimeFormat('ro-RO', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "de":
        publishedDate = new Intl.DateTimeFormat('de-DE', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "ar":
        publishedDate = new Intl.DateTimeFormat('ar-EG', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "ru":
        publishedDate = new Intl.DateTimeFormat('ru-RU', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;     
      case "zh_CN":
        publishedDate = new Intl.DateTimeFormat('zh-u-ca-chinese', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
      case "ja":
        publishedDate = new Intl.DateTimeFormat('ja-JP-u-ca-japanese', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break; 
      default:
        publishedDate = new Intl.DateTimeFormat('es-ES', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
        break;
    }
    publishedDate = publishedDate.substring(0, publishedDate.length-8);
    return publishedDate;

}


/**
 * Returns the language format for datatables
 * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
 * @param {string} language - The given language.
 * @return {string} - The date properly formatted with the language
 */

 function getLanguageDtFormat(language){
    let lang;
    
    switch(language){
      case "es":
        lang = "es";
        break;
      case "en":
        lang = "en";
        break;
      case "it":
        lang = "it";
        break;
      case "pt":
        lang = "pt";
        break;
      case "fr":
        lang = "fr";
        break;
      case "ro":
        lang = "ro";
        break;
      case "de":
        lang = "de";
        break;
      case "ar":
        lang = "ar";
        break;
      case "ru":
        lang = "ru";
        break;     
      case "zh_CN":
        lang = "zh-cn";
        break;
      case "ja":
        lang = "ja";
        break; 
      default:
        lang = "es";
        break;
    }
    return lang;

}