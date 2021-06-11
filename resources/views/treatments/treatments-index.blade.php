
@section('viewsScripts')

<script>


    let _mainTableAllUsersAjax = $('#mainTablePatientsTreatments').DataTable({
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
              url: _publicUrl + 'treatments/viewDT',
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
                data: 'blood',
            },
            {
                data: 'birthdate',
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
            @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_CREATE']) && $flagsMenuEnabled['MEDICAL_TREATMENT_CREATE'])
                {
                    data: '_create',
                    orderable: false,
                    render: function(data, type, row) {
                        // console.log(data, type, row);
                        let strButtons = "";
                        strButtons += ' <span> <a class="btn btn-primary createTreatment"';
                        // strButtons += ' href="">';  
                        strButtons += ' href="'+ _publicUrl+'treatments/'+row.users_id+'/create' +'">'; 
                        strButtons += ' <i class="fa fa-plus-circle"></i>&ensp;';
                        strButtons += _messagesLocalization.create_stat+'</a></span>';                                                                                                  
                        return strButtons;
                    }
                },
            @endif
            @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_FROM_SINGLE_PATIENT']) && $flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_FROM_SINGLE_PATIENT'])
                {
                    data: '_view',
                    orderable: false,
                    render: function(data, type, row) {
                        // console.log(data, type, row);
                        let strButtons = "";
                        strButtons += ' <span> <a class="btn btn-info viewTreatments"';
                        strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                        strButtons += ' data-id-user="'+row.users_id +'"'; 
                        // strButtons += ' href="">';  
                        strButtons += ' href="'+ _publicUrl+'treatments/'+row.users_id+'/indexSinglePatient' +'">'; 
                        strButtons += ' <i class="fa fa-eye"></i>&ensp;';
                        strButtons += _messagesLocalization.look_stat+'</a></span>';                                                                                                  
                        return strButtons;
                    }
                },
            @endif
            @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ALL_FROM_SINGLE_PATIENT']) && $flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ALL_FROM_SINGLE_PATIENT'])
                {
                    data: '_delete',
                    orderable: false,
                    render: function(data, type, row) {
                        // console.log(data, type, row);
                        let strButtons = "";
                        strButtons += ' <span> <a class="btn btn-danger confirmDeleteTreatment"';
                        strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                        strButtons += ' data-id-user="'+row.users_id +'"';     
                        // strButtons += ' href="">';  
                        strButtons += ' href="'+ _publicUrl+'ustreatmentsers/'+row.id+'/confirmDeleteAll' +'">';  
                        strButtons += ' <i class="fa fa-trash"></i>&ensp;';
                        strButtons += _messagesLocalization.delete_all_of_them+'</a></span>';                                                                                                  
                        return strButtons;
                    }
                },
            @endif
          ],
          "fnDrawCallback": function( oSettings ) {

            $('.confirmDeleteTreatment').on('click', function(e){
                e.preventDefault();
                let userDeleteId = $(this).data('id-user');
                let userDeleteFullName = $(this).data('name-user');

                showModal("@lang('messages.would_you_like_to_delete_all_the_treatments_of_the_user')"+' '+ userDeleteFullName + '?', 
                "@lang('messages.are_you_sure_you_want_to_delete_all_the_treatments_of_the_user_whose_name_is')"+ " " + userDeleteFullName + '?',
                false, null, 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 


                $('#saveModal').on('click', function(e){
                    console.log("si no?");
                    saveModalActionAjax(_publicUrl+"treatments/"+userDeleteId+"/deleteAll", userDeleteId, 'DELETE', 'json', function(res) {
                        if(res.status == 0) {
                            $('#mainTablePatientsTreatments').DataTable().ajax.reload();
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
        disableDataTablesMinCharactersSearch('#mainTablePatientsTreatments', 3, true);
        assignHeadersToRowsResponsive();
      });


</script>
@endsection
