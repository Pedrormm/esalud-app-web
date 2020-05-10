let allUsers;
let roles;
let _rolesForChange = {}
let _currentRolesForChange = {}

$(".selectCurrentRole").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    let roleId = this.options[clickedIndex].value;
    let userId = $(this).data('user-id');
    _currentRolesForChange[userId] = parseInt(roleId);
    saveModalActionAjax(PublicURL+"public/role/userManagementNotInRole/update", _currentRolesForChange, 'POST', 'json', function(res) {
    if(res.status == 0) {
        location.reload();
        showInlineMessage(res.message, 20);
        // $('td[data-role-id="' + roleId + '"]').text($('#name').val());
    }
    else {
        showInlineError(res.status, res.message, 5);
    }
    });
});

$(".selectCurrentRole").selectpicker();

$('#usersDistRole').on('click', function(e){
    e.preventDefault();
    showModal('Buscar usuarios con rol distinto a '+ $(this).data('name-role'), '', false, $(this).attr('href'), 
    'modal-xl', true, true); 
});


