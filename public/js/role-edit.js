var _tablaRolPermisos = $('#tablaRolPermisos').DataTable({
    responsive: true,
    pageLength : 5,
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "dom": '<"top"i>rt<"bottom"flp><"clear">',
    // dom: '<"pime-grid-button"B><"pime-grid-filter">frtip',

});

$('#saveModal').click(function() {

    var serializedReturn = $('#editRole').find("input:not([name*='check'])").serialize(); 
    var checks = _tablaRolPermisos.$('input, select').serialize();
    var data = serializedReturn + "&" + checks;
    var idRole = $('#idRole').val();

    // saveModalActionAjax(PublicURL+"user/roleManagement/update", data, 'GET', 'json', function(res) {
    saveModalActionAjax(PublicURL+"roles/"+editRole, data, 'PUT', 'json', function(res) {
        if(res.status == 0) {
            showInlineMessage(res.message, 5);
            $('#mainTableRoles').DataTable().ajax.reload();
            // $('td[data-role-id="' + roleId + '"]').text($('#name').val());
        }
        else {
            showInlineError(res.status, res.message, 5);
        }
        $('#saveModal').off("click");
    });
});