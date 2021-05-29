$('#roleDelete').click(function() {
    showModalConfirm(_messagesLocalization.want_to_delete_role, function(result){
        /* your callback code */ 
        $('.bootbox-accept').text("Delete");
    }, "delete");
    /*bootbox.confirm("¿Desea borrar el rol?", function(result){
        /* your callback code */ 
        $('.bootbox-accept').text("Delete");
    })*/
});
