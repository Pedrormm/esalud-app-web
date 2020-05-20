

$('#saveModal').click(function() {
    let that = this;
    saveModalActionAjax(PublicURL+"public/role/create", $('#newRole').serialize(), 'POST', 'json', function(res) {
        if(res.status == 0) {
            $('#mainTableRoles').DataTable().ajax.reload();
            showInlineMessage(res.message, 5);
        }
        else {
            showInlineError(res.status, res.message, 5);
        }
        console.log(that);
        $('#saveModal').off("click");
    });
});

    $('#name').focus();
    $('#name').donetyping(function(event){
        $(this).val(function () {
            return patternCase(this.value,/(?:-| |_)+/);
        })
        $( this ).off( event );
    });


