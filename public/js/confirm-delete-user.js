$('#saveModal').click(function() {
    let roleDeleteId = $('#sureDeleteRole').data("role-delete-id")
    saveModalActionAjax(_publicUrl+"users/"+roleDeleteId, roleDeleteId, 'DELETE', 'json', function(res) {
        if(res.status == 0) {
            $('#mainTableRoles').DataTable().ajax.reload();
            showInlineMessage(res.message, 10);
        }
        else {
            showInlineError(res.status, res.message, 10);
        }
        $('#saveModal').off("click");
    });
});