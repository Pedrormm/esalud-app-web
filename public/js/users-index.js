
$('.confirmDeleteUser').on('click', function(e){
    e.preventDefault();
    let userDeleteId = $(this).data('id-user');
    let userDeleteFullName = $(this).data('name-user');
    let userDeleteRole = $(this).data('role-user');

    showModal('¿Borrar usuario '+ userDeleteFullName + '?', 
    '¿Seguro que desea borrar el usuario con nombre '+ userDeleteFullName + ' y rol '+ userDeleteRole + '?',
     false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 

     $('#saveModal').on('click', function(e){
        saveModalActionAjax(_publicUrl+"users/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
            if(res.status == 0) {
                $('#mainTableRoles').DataTable().ajax.reload();
                showInlineMessage(res.message, 5);
            }
            else {
                showInlineError(res.status, res.message, 5);
            }
            $('#saveModal').off("click");
        });
    });

});


let isallUsersDelete = $('#isallUsersDelete').val();
if (isallUsersDelete == 1){
    console.log("isallUsersDelete ",isallUsersDelete);


    let _mainTableAllUsersAjax = $('#mainTableAllUsers').DataTable({
        serverSide : true,
        "responsive": true,
        "language": {
            "url": _urlDtLang
        },
      
        ajax: {
              // For the 419 unknown laravel status:
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              url: _publicUrl + 'users/viewDT',
              method: "POST",
              dataSrc: "data",
              xhrFields: {
                  withCredentials: true
              }
          },
      
        columns : [
            {
                data: 'fullName',
              
            },
            {
                data: 'role_name',
                
            },
            {
                data: 'dni'
            },
            {
                data: 'blood',
            },
            {
                data: 'birthdate',
            },
            {
                data: 'phone',
            },
            {
                data: 'sex'
            },
            {
                data: '_buttons',
                orderable: false,
                render: function(data, type, row, meta) {
                    console.log(data, type, row);
                    let strButtons = "";
                    if(row.buttonDelete) {
                        strButtons += '<button type="button" class="btn btn-danger btn-delete" data-id="'+row.id+'" data-index="'+meta.row+'">Borrar</button>';
                    }
                    if(row.buttonUpdate) {
                        strButtons += '<button type="button" class="btn btn-primary btn-update" data-id="'+row.id+'" data-index="'+meta.row+'">Update</button>';
                    }
                    return strButtons;
                }
            }
          ],
      
          "fnDrawCallback": function( oSettings ) {
              $('.role-modal').on('click', function(e){
                  e.preventDefault();
                  showModal('Editar rol '+ $(this).data('name-role'), '', false, $(this).attr('href'), 'modal-xl', true, true); 
              });
      
              $('.roleDelete').on('click', function(e){
                  e.preventDefault();
      
                  showModal('¿Borrar rol '+ $(this).data('name-role') + '?', $(this).data('name-role'), false, 
                  $(this).attr('href'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 
              });
          }
      }).on('draw', () => {
        //   console.log("entra draw");
          assignHeadersToRowsResponsive();
          $('.btn-delete').on('click', 'button',  function(e) {

          })
      });
      




}
else if (isallUsersDelete == 0){
    if ($('#mainTableAllUsers').length > 0 ){
        $('#mainTableAllUsers').DataTable({
            "responsive": true,
            "language": {
                "url": _urlDtLang
            },
        });
    }
}

