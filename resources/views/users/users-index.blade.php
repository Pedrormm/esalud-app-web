
@section('viewsScripts')
<script>
$('.confirmDeleteUser').on('click', function(e){
    e.preventDefault();
    let userDeleteId = $(this).data('id-user');
    let userDeleteFullName = $(this).data('name-user');
    let userDeleteRole = $(this).data('role-user');

    showModal("@lang('messages.would_you_like_to_delete_the_user')"+' '+ userDeleteFullName + '?', 
    "@lang('messages.are_you_sure_you_want_to_delete_the_user_whose_name_is')"+ " " + userDeleteFullName + " " + "@lang('messages.and_role')" + " " + userDeleteRole + '?',
     false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 

     $('#saveModal').on('click', function(e){
        saveModalActionAjax(_publicUrl+"users/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
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


    // console.log("isallUsersDelete ",isallUsersDelete);
    let _mainTableAllUsersAjax = $('#mainTableAllUsers').DataTable({
        serverSide : true,
        "responsive": true,
        @isset($pagination)
            paging: {{ $pagination }},
        @endisset
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
                    // console.log("DATOS "+ data, type, row);
                    let strFullName = "";
                    if (row.avatar){
                        strFullName += '<img class="avatar clearfix align-middle" src="'+ _publicUrl+'images/avatars/' + row.avatar + '" class="avatar big">';                                                                           
                    }
                    else{
                        if (row.sex=="male"){
                            strFullName += '<img class="avatar clearfix align-middle" src="'+'{{ asset("images/avatars/user_man.png") }}'+'" class="avatar big">';                                                                           
                        }
                        if (row.sex=="female"){
                            strFullName += '<img class="avatar clearfix align-middle" src="'+'{{ asset("images/avatars/user_woman.png") }}'+'" class="avatar big">';                                                                           
                        }
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
                data: 'sex',
                render: function(data, type, row) {
                    let strGender = "";

                    if (row.sex=="male"){
                        strGender += '<span class="align-middle">'+_messagesLocalization.male_data+'</span>';
                    }
                    else if (row.sex=="female"){
                        strGender += '<span class="align-middle">'+_messagesLocalization.female_data+'</span>';
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
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";

                    @if(isset($flagsMenuEnabled['ALL_USERS_EDIT']) && $flagsMenuEnabled['ALL_USERS_EDIT'])
                        strButtons += '<span><a href="'+ _publicUrl+'users/'+row.id+'/edit' +'"><i class="fa fa-edit"></i></a></span>';                                                                           
                    @else
                        strButtons += '<span><i class="fa fa-edit" style="color:gray"></i></span>';                                                                           
                    @endif    
                    @if(isset($flagsMenuEnabled['ALL_USERS_DELETE']) && $flagsMenuEnabled['ALL_USERS_DELETE'])

                        strButtons += ' <span> <a class="confirmDeleteUser"';
                        strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                        strButtons += ' data-role-user="'+row.role_name+'"';
                        strButtons += ' data-id-user="'+row.id +'"';
                        strButtons += ' href="'+ _publicUrl+'users/'+row.id+'/confirmDelete' +'">';  
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

                showModal("@lang('messages.would_you_like_to_delete_the_user')"+' '+ userDeleteFullName + '?', 
                "@lang('messages.are_you_sure_you_want_to_delete_the_user_whose_name_is')"+ " " + userDeleteFullName + " " + "@lang('messages.and_role')"+ " " + userDeleteRole + '?',
                false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 

                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(_publicUrl+"users/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
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
          disableDataTablesMinCharactersSearch('#mainTableAllUsers', 3, true);
          assignHeadersToRowsResponsive();
      });
      



// }


</script>
@endsection
