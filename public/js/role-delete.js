$('#roleDelete').click(function() {
    showModalConfirm("¿Desea borrar el rol?", function(result){
        /* your callback code */ 
        $('.bootbox-accept').text("Delete");
    }, "delete");
    /*bootbox.confirm("¿Desea borrar el rol?", function(result){
        /* your callback code */ 
        $('.bootbox-accept').text("Delete");
    })*/
});
