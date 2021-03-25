
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


let isallUsersDelete = $('#isallUsersDelete').val();
if (isallUsersDelete == 1){
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
        /*
        columnDefs: [
              {
                  "targets": 0,
                  'createdCell':  function (td, cellData, rowData, row, col) {
                      //console.log("Yo toy el td", td, "con cellData", cellData, "rowData=", rowData, "row=", row, "y col=", col);
                      $(td).data('role-id', rowData.idRole); 
                  },
                  
              },
              {
                  "render": function ( data, type, row ) {
                      return     '<a href="'+PublicURL+'roles/userManagement/edit/'+row.idRole+'"' + 
                                  ' class="btn btn-primary role-users-modal" data-name-role="' + row.nameRole + 
                                  '" data-role-id="'+ row.idRole +'" role="button">'+
                                  'Usuarios asociados' +
                                  '</a>'
                  },
                  "targets": 1
              },
              {
                  "render": function ( data, type, row ) {
                      // return     '<a href="'+PublicURL+'user/roleManagement/edit/'+row.idRole+'"' + 
                      return     '<a href="'+PublicURL+'roles/'+row.idRole+'/edit/'+'"' + 
                                  ' class="btn btn-primary role-modal" data-name-role="' + row.nameRole + 
                                  '" data-role-id="'+ row.idRole +'" role="button">'+
                                  'Editar' +
                                  '</a>'
                  },
                  "targets": 4
              },
              {
                  "render": function ( data, type, row ) {
                      // return     '<a href="'+PublicURL+'role/confirmDelete/'+row.idRole+'"' + 'id="roleDelete"'+
                      var isDisabled = row.delible == 1 ? " isDisabled" : "";
                      return     '<a href="'+PublicURL+'roles/'+row.idRole+'/confirmDelete/'+'"' + 
                                  ' class=\"btn btn-danger roleDelete' +isDisabled+'\"'+
                                  ' data-name-role="' + row.nameRole + 
                                  '" data-role-id="'+ row.idRole +'" role="button">'+
                                  '<i class="fa fa-trash"></i>&ensp;Borrar' +
                                  '</a>'
                  },
                  "targets": 5
              },
              {
                  "render": function ( data, type, row ) {
                      console.log("fila es",row);
                      console.log("data es",data);
                      console.log("type es",type);
                     
                      var parseWithHeaderColumnHidden = (data) => {
                          return '<table><tr><td class="header-toggle-hidden">'+ row.parent.child(0).innerText +'</td><td>'+data+'</td></tr></table>';
                      };
                      return  parseWithHeaderColumnHidden(row.nameRole);
                  },
                  "targets": 1
              }
          ],*/
      
          "fnDrawCallback": function( oSettings ) {
              $('.role-modal').on('click', function(e){
                  e.preventDefault();
                  showModal('Editar rol '+ $(this).data('name-role'), '', false, $(this).attr('href'), 'modal-xl', true, true); 
              });
      
              $('.roleDelete').on('click', function(e){
                  e.preventDefault();
                  
                  // showModal('¿Borrar rol '+ $(this).data('name-role') + '?', $(this).data('name-role'), false, 
                  // $(this).attr('href'), 'modal-xl', true, true); 
      
                  showModal('¿Borrar rol '+ $(this).data('name-role') + '?', $(this).data('name-role'), false, 
                  $(this).attr('href'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 
              });
          }
      }).on('draw', () => {
          console.log("entra draw");
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
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
        });
    }
}

