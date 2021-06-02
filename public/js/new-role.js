var _tablaNuevoRolPermisos = $('#tablaNuevoRolPermisos').DataTable({
    responsive: true,
    pageLength : 5,
    language: {
        url: _urlDtLang
    },
    "dom": '<"top"i>rt<"bottom"flp><"clear">',
});


var roleToBeNew = document.getElementById('name');

$('#saveModal').click(function() {
    let messages = [];

    if (roleToBeNew.value === '' || roleToBeNew.value == null) {
        messages.push(_messagesLocalization.the_role_name_is_required);
    }

    if (roleToBeNew.value.length < 2){
        messages.push(_messagesLocalization.the_role_name_must_be_at_least_2_characters_long);
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
        // saveModalActionAjax(_publicUrl+"role/create", data, 'POST', 'json', function(res) {
        saveModalActionAjax(_publicUrl+"roles", data, 'POST', 'json', function(res) {
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
        if (_dictionary){
            $(this).val(function () {
                return patternCase(this.value,/(?:-| |_)+/);
            })
        }

        $( this ).off( event );
    });


