$(function() {

    if ($('#dataTable').length > 0 ){
        $('#dataTable').DataTable({
            // "responsive": true,
            // "scrollY": 250,
            // "language": {
            //     "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            // },
            // dom: '<"toolbar">frtip',
            // fnInitComplete: function(){
            //     $('div.toolbar').html('Custom tool bar!');
            // },
            "dom": '<"toolbar">flrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },

        });
    }
   
    // $("div.toolbar").html
    // ('<input type="checkbox" name="select_all" value="1" id="example-select-all"><lable>Get all Records</lable>');




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

    let funcName = "saveasoghag";
    console.log("datos: ",data);

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
 * @author Pedro deMadrid
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
function showModal(title, body, htmlFormat, url = null, size=null, drageable=false, collapseable=false) {
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
            url: url,

        }).done(function(res) {
            $('#generic-modal .modal-body').html(res);
        });
        //$('#generic-modal').modal('show').find('.modal-body').load(url);
        //$('#generic-modal .modal-body').load(url);
        //$('#generic-modal .modal-body').html(url);
        //$('#generic-modal').modal('show');
    } 
    else
        $('#generic-modal .modal-body').text(body);

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


}//--fin showModal


function showModalConfirm(title="Title", message="No message", callback=function(){}, optConfirmText="Ok") {
    $('#generic-modal .modal-title').text(title);
    $('#generic-modal .modal-body').text(message);
    callback = (function() {
        let cachedFunction = callback;
        return function() {
            console.log("Calling callback before");
            cachedFunction.apply(this, arguments);
            $('#generic-modal').modal('hide');
            console.log("Calling callback afger");
        }
    })();

    $('#saveModal').click(callback);
    
    if(optConfirmText !== undefined) {
        $('#saveModal').text(optConfirmText);
    }
    $('#generic-modal').modal('show');
}//--fin showModalConfirm


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
  }

function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
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

