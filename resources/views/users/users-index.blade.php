
@section('scriptsPropios')

<script>

$('.confirmDeleteUser').on('click', function(e){
    e.preventDefault();
    let userDeleteId = $(this).data('id-user');
    let userDeleteFullName = $(this).data('name-user');
    let userDeleteRole = $(this).data('role-user');

    showModal('¿Borrar usuario '+ userDeleteFullName + '?', 
    '¿Seguro que desea borrar el usuario con nombre '+ userDeleteFullName + ' y rol '+ userDeleteRole + '?',
     false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 

     $('#saveModal').on('click', function(e){
        saveModalActionAjax(PublicURL+"users/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
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


// let isallUsersDelete = $('#isallUsersDelete').val();
// if (isallUsersDelete == 1){
@if((isset($flagsMenuEnabled['ALL_USERS_DELETE'])) && ($flagsMenuEnabled['ALL_USERS_DELETE']))

    console.log("isallUsersDelete ",isallUsersDelete);


    let _mainTableAllUsersAjax = $('#mainTableAllUsers').DataTable({
        serverSide : true,
        "responsive": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
      
        ajax: {
              // For the 419 unknown laravel status:
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              url: PublicURL + 'users/viewDT',
              method: "POST",
              dataSrc: "data",
              xhrFields: {
                  withCredentials: true
              }
          },

          columnDefs: [
            {
                targets: 0,
                className: 'dt-body-left'
            }
            ],
      
        columns : [
            {
                data: 'fullName',
                render: function(data, type, row) {
                    console.log("DATOS "+ data, type, row);
                    let strFullName = "";
                    if (row.sex=="male"){
                        strFullName += '<img class="avatar clearfix align-middle" src="'+'{{ asset("images/avatars/user_man.png") }}'+'" class="avatar big">';                                                                           
                    }
                    if (row.sex=="female"){
                        strFullName += '<img class="avatar clearfix align-middle" src="'+'{{ asset("images/avatars/user_woman.png") }}'+'" class="avatar big">';                                                                           
                    }

                    strFullName += '<span class="align-middle">'+data+'</span>';
                    
                    return strFullName;
                }
              
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
                render: function(data, type, row) {
                    console.log(data, type, row);
                    let strButtons = "";

                    @if(isset($flagsMenuEnabled['ALL_USERS_EDIT']) && $flagsMenuEnabled['ALL_USERS_EDIT'])
                        strButtons += '<span><a href="'+ PublicURL+'users/'+row.id+'/edit' +'"><i class="fa fa-edit"></i></a></span>';                                                                           
                    @else
                        strButtons += '<span><i class="fa fa-edit" style="color:gray"></i></span>';                                                                           
                    @endif    
                    @if(isset($flagsMenuEnabled['ALL_USERS_DELETE']) && $flagsMenuEnabled['ALL_USERS_DELETE'])

                        strButtons += ' <span> <a class="confirmDeleteUser"';
                        strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                        strButtons += ' data-role-user="'+row.role_name+'"';
                        strButtons += ' data-id-user="'+row.id +'"';
                        strButtons += ' href="'+ PublicURL+'users/'+row.id+'/confirmDelete' +'">';  
                        strButtons += ' <i class="fa fa-trash"></i></a></span>';                                                                                                  
 
                    @else
                        strButtons += ' <span><i class="fa fa-trash" style="color:gray"></i></span> ';
                        
                    @endif  

                    return strButtons;
                }
            }
          ],
          "fnDrawCallback": function( oSettings ) {
            $('.confirmDeleteUser').on('click', function(e){
                e.preventDefault();
                let userDeleteId = $(this).data('id-user');
                let userDeleteFullName = $(this).data('name-user');
                let userDeleteRole = $(this).data('role-user');

                showModal('¿Borrar usuario '+ userDeleteFullName + '?', 
                '¿Seguro que desea borrar el usuario con nombre '+ userDeleteFullName + ' y rol '+ userDeleteRole + '?',
                false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 

                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(PublicURL+"users/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
                        if(res.status == 0) {
                            $('#mainTableAllUsers').DataTable().ajax.reload();
                            showInlineMessage(res.message, 5);
                        }
                        else {
                            showInlineError(res.status, res.message, 5);
                        }
                        $('#saveModal').off("click");
                    });
                });
            });

          }
      }).on('draw', () => {
          console.log("entra draw");
          disableDataTablesMinCharactersSearch('#mainTableAllUsers', 3, true);
          assignHeadersToRowsResponsive();
      });
      




// }
@else(!(isset($flagsMenuEnabled['ALL_USERS_DELETE'])) && !($flagsMenuEnabled['ALL_USERS_DELETE']))
// else if (isallUsersDelete == 0){
    if ($('#mainTableAllUsers').length > 0 ){
        $('#mainTableAllUsers').DataTable({
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
        });
    }
// }

@endif


</script>
@endsection
