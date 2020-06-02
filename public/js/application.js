$(function() {

    if ($('#dataTable').length > 0 ){
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
        });
    }




});//#TAG: #onload-jquery
let PublicURL= location.href.substr(0, location.href.indexOf('public'));  
let roleId;

function asyncCall(endpoint, jQselector, displayErrorOnLayer, forceDisplay) {
    
    console.log("Calling asyncCall with args", arguments);
    if(typeof displayErrorOnLayer != 'boolean')
        displayErrorOnLayer = false;
    if(typeof forceDisplay != 'boolean')
        forceDisplay = true;
    $.ajax(_PUBLIC_URL + endpoint, {
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
       
        if(displayErrorOnLayer) {
           
            $(jQselector).html('<div class="alert alert-danger">ERROR: No se pudo cargar contenido en destino</div>');
        }
    });
}

function saveModalActionAjax(url, data={}, method='PUT', type='json', callbackOkFunction=function(){}, closeModal=true) {

    let funcName = "saveModalActionAjax";
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
function showInlineError(status,message, timeout=0) {
    $('#error-container').show().text(message);
    if(timeout>0) {
        setTimeout(function() {
            $('#error-container').hide(500);
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
    // $('#message-container').show().text('this\n has\\n <br> new\r\n lines');
    // $('#message-container').show().html("<strong>Leave blanco if there is already a Record<br>for today!&#13;&#10;This will auto-calculate based on the previous Record.</strong>");

    if(timeout>0) {
        setTimeout(function() {
            $('#message-container').hide(500);
        }, timeout*1000);
    }
}
function showModal(title, body, htmlFormat, url = null, size=null, drageable=false, collapseable=false, 
     removeApp=false, secondstoCancel=null) {
    $('#generic-modal .modal-body').text('');
    $('#generic-modal .modal-title').text(title);
    if (size){
        $('.modal-dialog').addClass(size);
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
                //console.log("Pero yo quien soy?");
            //Esto no hace nada $( this ).off( event );
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
    let mainId = '#generic-modal';
    let buttonOkId = '#saveModal';
    let buttonCloseId = '#closeModal';
    $('.modal-title').text(title);
    $(mainId + ' .modal-body').text(message);
    callback = (function() {
        let cachedFunction = callback;
        return function() {
            cachedFunction.apply(this, arguments);
            $(mainId).modal('hide');
        }
    })();

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
}



