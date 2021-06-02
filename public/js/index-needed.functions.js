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


}//--fin showModal

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


function isMobile(){
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        return true
    }
    else{
        return false
    }
} 

function isABootstrapModalOpen() {
    return $('.modal.show').length >0;
}