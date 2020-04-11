$('#saveModal').click(function() {
    saveModalActionAjax($('#urlRole').val(), $('#editRole').serialize(), 'PUT', 'json', function(res) {
        if(res.status == 0) {
        showInlineMessage(res.message);
        }
        else {
        showInlineError(res.status, res.message);
        }
    });
});