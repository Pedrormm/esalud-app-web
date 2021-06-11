a
@section('viewsScripts')

<script>
    $('.cHeader button').on('click', function(e){
        e.preventDefault();
        window.location.href = _publicUrl+"treatments/";
    });

    let _mainTableAllUsersAjax = $('#TableTreatmentsSinglePatient').DataTable({
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
              url: _publicUrl + 'treatments/singlePatient/'+{{ $userId }}+'/viewDT',
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
                data: 'startingDate'   
            },
            {
                data: 'endingDate'
            },
            {
                data: 'doctorFullName',
            },
            {
                data: 'nameTypeMedicine',
            },
            {
                data: 'medicineAdministration'
            },
            @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_EDIT']) && $flagsMenuEnabled['MEDICAL_TREATMENT_EDIT'])
                {
                    data: '_edit',
                    orderable: false,
                    render: function(data, type, row) {
                        // console.log(data, type, row);
                        let strButtons = "";
                        strButtons += ' <span> <a class="btn btn-primary confirmEditTreatment"';
                        // strButtons += ' href="">';  
                        strButtons += ' href="'+ _publicUrl+'treatments/'+row.id+'/edit' +'">'; 
                        strButtons += ' <i class="fa fa-edit"></i>&ensp;';
                        strButtons += _messagesLocalization.edit_stat+'</a></span>';                                                                                                  
                        return strButtons;
                    }
                },
            @endif
            @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_DESCRIPTION']) && $flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_DESCRIPTION'])
                {
                    data: '_look',
                    orderable: false,
                    render: function(data, type, row) {
                        // console.log(data, type, row);
                        let strButtons = "";
                        strButtons += ' <span> <a class="btn btn-info confirmLookTreatment"';
                        strButtons += ' data-id="'+row.id+'"';
                        // strButtons += ' href="">';  
                        strButtons += ' href="'+ _publicUrl+'treatments/'+row.id+'/viewDescription' +'">'; 
                        strButtons += ' <i class="fa fa-eye"></i>&ensp;';
                        strButtons += _messagesLocalization.look_stat+'</a></span>';    

                        return strButtons;
                    }
                },
            @endif
            @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ONE']) && $flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ONE'])
                {
                    data: '_delete',
                    orderable: false,
                    render: function(data, type, row) {
                        // console.log(data, type, row);
                        let strButtons = "";
                        strButtons += ' <span> <a class="btn btn-danger confirmSingleDeleteTreatment"';
                        strButtons += ' data-id-treatment="'+row.id +'"'; 
                        strButtons += ' href="">';  
                        strButtons += ' <i class="fa fa-trash"></i>&ensp;';
                        strButtons += _messagesLocalization.delete_stat+'</a></span>';                                                                                                  
                        return strButtons;
                    }
                },
            @endif
          ],
          "fnDrawCallback": function( oSettings ) {


            $('.confirmLookTreatment').on('click', function(e){
                e.preventDefault();

                showModal("@lang('messages.description_of_the_treatment')", $(this).data('id'), false, 
                $(this).attr('href'), 'modal-xl', true, true, false, null, null, "@lang('messages.close_stat')", "@lang('messages.yes_response')"); 
            });


            $('.confirmSingleDeleteTreatment').on('click', function(e){
                e.preventDefault();
                let treatmentDeleteId = $(this).data('id-treatment');

                showModal("@lang('messages.would_you_like_to_delete_the_treatment')" + '?', 
                "@lang('messages.are_you_sure_you_want_to_delete_the_treatment')" + '?',
                false, null, 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 


                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(_publicUrl+"treatments/"+treatmentDeleteId, treatmentDeleteId, 'DELETE', 'json', function(res) {
                        if(res.status == 0) {
                            $('#TableTreatmentsSinglePatient').DataTable().ajax.reload();
                            showInlineMessage(res.message, 10);
                        }
                        else {
                            showInlineError(res.status, res.message, 10);
                        }
                        $('#saveModal').off("click");
                    });
                });
            });
          }
      }).on('draw', () => {
        //   console.log("entra draw");
          disableDataTablesMinCharactersSearch('#TableTreatmentsSinglePatient', 3, true);
          assignHeadersToRowsResponsive();
          let id = {{ $userId }};
        //   $('.confirmEditTreatment').on("click",function(e){
        //         e.preventDefault();
        //         alert(id);
        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }, 
        //             url: $('.confirmEditTreatment').attr('href'),
        //             method:"GET",
        //             data: {id: id},
        //             dataType:"json",
        //             contenttype: "application/json; charset=utf-8",
        //         }).done(function(response){
        //             console.log("resp ", response);
        //             // $('body').empty().html(response.obj);
        //             // showInlineMessage(response.message, 30);
        //             // console.log("app ",response.obj);

        //         });
        //     });
      });
      






</script>
@endsection
