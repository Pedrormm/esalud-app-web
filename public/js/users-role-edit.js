$.fn.dataTable.ext.errMode = 'throw';
let _dataTableRoles = $('#tableRoles').DataTable({
  
  "responsive": true,
  "language": {
    "url": _urlDtLang
  },

  ajax: {
            // For the 419 unknown laravel status:
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: _publicUrl + 'roles/userManagementInRole/edit/' + currentIdRole,
            method: "POST",
            dataSrc: "data",
            xhrFields: {
                withCredentials: true
            }
        },

  columns : [
            { "data" : "id" },
            { "data" : "name" },
            { "data" : "dni" },
            { "data" : "birthdate" },
            { "data" : "sex" },
            { "data" : "blood" },
            {  }
        ],

  columnDefs: [
            {
                "render": function ( data, type, row ) {
                    // console.log("fila ",row);
                    let roleId = row.role_id;
                    let selectedAttr = '';
                    let options = [];
                    roles.forEach(function (roleItem, roleIndex) {
                        // console.log("Comparing backend role id "+  roleItem.id +" vs " + roleId);
                        if( roleItem.id == roleId)
                          selectedAttr = "selected ";
                        else
                          selectedAttr = '';
                        options.push( '<option '+ selectedAttr +'value="'+roleItem.id+'">'+roleItem.name+'</option>');
                    });

                    // console.log(options);
                    return ' <select class="selectpicker show-tick selectCurrentRole" data-width="100%" data-live-search="true" '+
                          'data-style="btn-success" data-user-id="'  + row.id + '" id="selectCurrentRole">'+
                            options.join('');
                          '</select>';
                },
                "targets": -1
            },
            {
                "render": function ( data, type, row ) {
                  return row.name + " " + row.lastname;
                },
                "targets": 1
            },
            {
                "render": function ( data, type, row ) {
                  return getAge(row.birthdate) + " años";
                },
                "targets": 3
            },
        ],

        "fnDrawCallback": function( oSettings ) {
          let allUsers;
          let _rolesForChange = {};
          let _currentRolesForChange = {};

          $(".selectCurrentRole").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
              let roleId = this.options[clickedIndex].value;
              let userId = $(this).data('user-id');
              _currentRolesForChange[userId] = parseInt(roleId);
              saveModalActionAjax(_publicUrl+"roles/userManagementNotInRole/update", _currentRolesForChange, 'POST', 'json', function(res) {
              if(res.status == 0) {
                  $('#tableRoles').DataTable().ajax.reload();
                  showInlineMessage(res.message, 20);
              }
              else {
                  showInlineError(res.status, res.message, 5);
              }
              });
          });

          $(".selectCurrentRole").selectpicker();

        }

}).on( 'draw.dt', function () {
  console.log("algo");
  clickOnSelectpicker();
});

$('#usersDistRole').on('click', function(e){
    e.preventDefault();
    showModal('Buscar usuarios con rol distinto a '+ $(this).data('name-role'), '', false, $(this).attr('href'), 
    'modal-xl', true, true); 
});

$('.cHeader button').on('click', function(e){
  e.preventDefault();
  window.location.href = _publicUrl+"roles/";
});


