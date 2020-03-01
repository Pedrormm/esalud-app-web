$(function() {

});//#TAG: #onload-jquery

function asyncCall(endpoint, jQselector, displayErrorOnLayer) {
    console.log("Calling asyncCall with args", arguments);
    if(typeof displayErrorOnLayer != 'boolean')
        displayErrorOnLayer = false;
    $.ajax(_PUBLIC_URL + endpoint, {
        method:'get',
        dataType:'html',
        async:true,
    }).done(function(res, st, xhr) {

        //console.log("success arguments", arguments);
        if($(jQselector).length) {
            $(jQselector).html(res);
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


function showModal(title, body, htmlFormat) {
    $('#generic-modal .modal-title').text(title);
    if(htmlFormat)
        $('#generic-modal .modal-body p').html(body);
    else
        $('#generic-modal .modal-body p').text(body);
    $('#generic-modal').modal('show');

}