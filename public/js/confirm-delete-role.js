$('#saveModal').click(function() {
    let roleDeleteId = $('#sureDeleteRole').data("role-delete-id")
    saveModalActionAjax(PublicURL+"roles/"+roleDeleteId, roleDeleteId, 'DELETE', 'json', function(res) {
        if(res.status == 0) {
            $('#mainTableRoles').DataTable().ajax.reload();
            showInlineMessage(res.message, 5);
        }
        else {
            showInlineError(res.status, res.message, 5);
        }
        $('#saveModal').off("click");
    });
});