$('#saveModal').click(function() {
    saveModalActionAjax(PublicURL+"public/user/roleManagement/update", $('#editRole').serialize(), 'GET', 'json', function(res) {
        if(res.status == 0) {
            showInlineMessage(res.message, 5);
            $('#mainTableRoles').DataTable().ajax.reload();
            // $('td[data-role-id="' + roleId + '"]').text($('#name').val());
        }
        else {
            showInlineError(res.status, res.message, 5);
        }
    });
});