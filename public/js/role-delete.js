$('#roleDelete').click(function() {
    showModalConfirm(_messagesLocalization.want_to_delete_role, function(result){
        /* callback */ 
        $('.bootbox-accept').text(_messagesLocalization.delete_stat);
    }, _messagesLocalization.delete_stat);
    
});
