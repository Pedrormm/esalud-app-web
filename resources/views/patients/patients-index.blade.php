
@section('viewsScripts')

<script>



    let _mainTableAllUsersAjax = $('#mainTablePatients').DataTable({
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
              url: _publicUrl + 'patients/viewDT',
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
                data: 'historic',              
            },
            {
                data: 'height',
                render: function(data, type, row) {
                    let strHeight = "";

                    if (row.height=="0"){
                        strHeight += '<span class="align-middle">'+data+'</span>';
                    }
                    else{
                        strHeight += '<span class="align-middle">'+data+' cm</span>';
                    }
                    
                    return strHeight;
                }
            },
            {
                data: 'weight',
                render: function(data, type, row) {
                    let strWeight = "";

                    if (row.weight=="0"){
                        strWeight += '<span class="align-middle">'+data+'</span>';
                    }
                    else{
                        strWeight += '<span class="align-middle">'+data+' kg</span>';
                    }
                    
                    return strWeight;
                }
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

                    @if(isset($flagsMenuEnabled['PATIENT_USER_EDIT']) && $flagsMenuEnabled['PATIENT_USER_EDIT'])
                        strButtons += '<span><a href="'+ _publicUrl+'patients/'+row.users_id+'/edit' +'"><i class="fa fa-edit"></i></a></span>';                                                                           
                    @else
                        strButtons += '<span><i class="fa fa-edit" style="color:gray"></i></span>';                                                                           
                    @endif    
                    @if(isset($flagsMenuEnabled['PATIENT_USER_DELETE']) && $flagsMenuEnabled['PATIENT_USER_DELETE'])

                        strButtons += ' <span> <a class="confirmDeleteUser"';
                        strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                        strButtons += ' data-role-user="'+row.role_name+'"';
                        strButtons += ' data-id-user="'+row.users_id +'"';
                        strButtons += ' href="'+ _publicUrl+'patients/'+row.users_id+'/confirmDelete' +'">';  
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
                "@lang('messages.would_you_like_to_delete_the_user_whose_name_is')"+' '+ userDeleteFullName + " " + "@lang('messages.and_role')"+ " " + userDeleteRole + '?',
                false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 

                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(_publicUrl+"patients/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
                        if(res.status == 0) {
                            $('#mainTablePatients').DataTable().ajax.reload();
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
          disableDataTablesMinCharactersSearch('#mainTablePatients', 3, true);
          assignHeadersToRowsResponsive();
      });
      






</script>
@endsection
