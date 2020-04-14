$('#saveModal').click(function() {
    console.log('role-edit.js');
    saveModalActionAjax($('#urlRole').val(), $('#editRole').serialize(), 'PUT', 'json', function(res) {
        if(res.status == 0) {
            showInlineMessage(res.message, 5);
            $('td[data-role-id="' + roleId + '"]').text($('#name').val());
        }
        else {
            showInlineError(res.status, res.message, 5);
        }
    });
});