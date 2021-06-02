
$('.confirmDeleteUser').on('click', function(e){
    e.preventDefault();
    let userDeleteId = $(this).data('id-user');
    let userDeleteFullName = $(this).data('name-user');
    let userDeleteRole = $(this).data('role-user');

    showModal(_messagesLocalization.would_you_like_to_delete_the_user+' '+ userDeleteFullName + '?', 
    _messagesLocalization.would_you_like_to_delete_the_user_whose_name_is+' '+ userDeleteFullName + " " + _messagesLocalization.and_role + " " + userDeleteRole + '?',
     false, $(this).data('link'), 'modal-xl', true, true, false, null, null, _messagesLocalization.no_response, _messagesLocalization.yes_response); 

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
                data: 'sex',
                render: function(data, type, row) {
                    let strGender = "";

                    if (row.sex=="male"){
                        strGender += '<span class="align-middle">'+ _messagesLocalization.male_data +'</span>';
                    }
                    else if (row.sex=="female"){
                        strGender += '<span class="align-middle">'+ _messagesLocalization.female_data +'</span>';
                    }
                    else{
                        strGender += '<span class="align-middle"> </span>';
                    }
                    
                    return strGender;
                }
            },
            {
                data: '_buttons',
                orderable: false,
                render: function(data, type, row, meta) {
                    console.log(data, type, row);
                    let strButtons = "";
                    if(row.buttonDelete) {
                        strButtons += '<button type="button" class="btn btn-danger btn-delete" data-id="'+row.id+'" data-index="'+meta.row+'">';
                        strButtons += _messagesLocalization.delete_stat+'</button>';
                    }
                    if(row.buttonUpdate) {
                        strButtons += '<button type="button" class="btn btn-primary btn-update" data-id="'+row.id+'" data-index="'+meta.row+'">';
                        strButtons += _messagesLocalization.update_stat+'</button>';
                    }
                    return strButtons;
                }
            }
          ],
      
          "fnDrawCallback": function( oSettings ) {
              $('.role-modal').on('click', function(e){
                  e.preventDefault();
                  showModal(_messagesLocalization.edit_stat_role+' '+ $(this).data('name-role'), '', false, $(this).attr('href'), 'modal-xl', true, true); 
              });
      
              $('.roleDelete').on('click', function(e){
                  e.preventDefault();
      
                  showModal(_messagesLocalization.would_you_like_to_delete_the_role+' '+ $(this).data('name-role') + '?', $(this).data('name-role'), false, 
                  $(this).attr('href'), 'modal-xl', true, true, false, null, null, _messagesLocalization.no_response, _messagesLocalization.yes_response); 
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

