var _tablaNuevoRolPermisos = $('#tablaNuevoRolPermisos').DataTable({
    responsive: true,
    pageLength : 5,
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "dom": '<"top"i>rt<"bottom"flp><"clear">',
});


var roleToBeNew = document.getElementById('name');

$('#saveModal').click(function() {
    let messages = [];

    if (roleToBeNew.value === '' || roleToBeNew.value == null) {
        messages.push("The role name is required");
    }

    if (roleToBeNew.value.length < 2){
        messages.push("The role name must be at least 2 characters long");
    }

    if (messages.length > 0) {
        showInlineError(1, messages.join(', '), 10, true);             
    }
    else{
        var serializedReturn = $('#newRole').find("input:not([name*='check'])").serialize(); 
        var checks = _tablaNuevoRolPermisos.$('input, select').serialize();
        var data = serializedReturn + "&" + checks;
        console.log(data);
        let that = this;
        saveModalActionAjax(PublicURL+"role/create", data, 'POST', 'json', function(res) {
            if(res.status == 0) {
                $('#mainTableRoles').DataTable().ajax.reload();
                showInlineMessage(res.message, 5);
            }
            else {
                showInlineError(res.status, res.message, 5);
            }
            // console.log(that);
            $('#saveModal').off("click");
        });
    }
});

    $('#name').focus();
    $('#name').donetyping(function(event){
        $(this).val(function () {
            return patternCase(this.value,/(?:-| |_)+/);
        })
        $( this ).off( event );
    });


