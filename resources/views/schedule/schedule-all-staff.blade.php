
@section('viewsScripts')

<script>


    $('#scheduleStaffTable').DataTable({
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
              url: _publicUrl + 'schedule/viewDT',
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
                data: 'dni'
            },
            {
                data: 'role_name',            
            },
            {
                data: 'branch_name',
            },
            {
                data: 'birthdate',
            },
            {
                data: 'sex',
            },
            {
                data: '_edit',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-info viewTreatments"';
                    strButtons += ' data-id-user="'+row.users_id +'"'; 
                    strButtons += ' href="'+ _publicUrl+'schedule/staff/'+row.users_id+'">'; 
                    strButtons += ' <i class="fa fa-eye"></i>&ensp;'; 
                    strButtons += _messagesLocalization.look_stat+'</a></span>';                                                                                                   
                    return strButtons;
                }
            },
            {
                data: '_delete',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-danger confirmDeleteTreatment"';
                    strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                    strButtons += ' data-id-user="'+row.users_id +'"';
                    strButtons += ' href="'+ _publicUrl+'schedule/staff/'+row.users_id+'/confirmDelete' +'">';  
                    strButtons += ' <i class="fa fa-trash"></i>&ensp;';
                    strButtons += _messagesLocalization.delete_stat_schedule+'</a></span>';                                                                                                  
                    return strButtons;
                }
            },
          ],
          "fnDrawCallback": function( oSettings ) {
            $('.confirmDeleteTreatment').on('click', function(e){
                e.preventDefault();
                let scheduleDeleteId = $(this).data('id-user');
                let scheduleDeleteFullName = $(this).data('name-user');
                
                showModal("@lang('messages.do_you_want_to_the_delete_the_schedule_of_the_user')"+ scheduleDeleteFullName + '?', 
                "@lang('messages.are_you_sure_you_want_to_delete_all_schedules_of_the_user')"+ scheduleDeleteFullName + '?',
                false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 

                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(_publicUrl+"schedule/"+scheduleDeleteId, scheduleDeleteId, 'DELETE', 'json', function(res) {
                        if(res.status == 0) {
                            $('#scheduleStaffTable').DataTable().ajax.reload();
                            showInlineMessage(res.message, 15);
                        }
                        else {
                            showInlineError(res.status, res.message, 15);
                        }
                        $('#saveModal').off("click");
                    });
                });
            });
          }
      }).on('draw', () => {
          disableDataTablesMinCharactersSearch('#scheduleStaffTable', 3, true);
          assignHeadersToRowsResponsive();
      });
      

</script>
@endsection
