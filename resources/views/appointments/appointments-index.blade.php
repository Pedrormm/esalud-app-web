
@section('viewsScripts')

<script>
    

    $('.editarCita').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');
        showModal('Editar cita '+ id, '', false, $(this).attr('href') + "/"+ id + "/edit", 'modal-xl',
        true, true, false, null, function() {
            
                $('#saveEditAppointment').submit();
            
        }); 
    });

    $('.btnAcceptAppointment').click((e) => {
        let id=$(this).data('id');
        
    });
// $('#mainTableAllAppointments').DataTable().page.info()
    let _mainTableAllAppointmentsAjax = $('#mainTableAllAppointments').DataTable({
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
              url: _publicUrl + 'appointment/viewDT/'+'{{ $appointmentType }}',
              method: "POST",
            //   data: {id: contactId},
            //   data: {pgno: page.info().page},
              dataSrc: "data",
              xhrFields: {
                  withCredentials: true
              }
          },

          columnDefs: [
            {
                // targets: 0,
                // className: 'dt-body-left'
            }
            ],
      
        columns : [
            @if (( auth()->user()->role_id) != \HV_ROLES::PATIENT)
            {
                data: 'patientFullName'
            },
            @endif
            @if (( auth()->user()->role_id) != \HV_ROLES::DOCTOR)
            {
                data: 'doctorFullName',
            },
            @endif  
            {
                data: 'dt_appointment',
            },
            @if (($appointmentType) == "all")
            {
                data: 'checkedStatus',
            },
            @endif
            {
                data: '_buttons',
                orderable: false,

                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <div class="d-flex justify-content-center">';                                          
                    @if((auth()->user()->role_id == \HV_ROLES::PATIENT) || (auth()->user()->role_id == \HV_ROLES::DOCTOR)
                    || (auth()->user()->role_id == \HV_ROLES::ADMIN))
                        @if (($appointmentType) != "old")

                            strButtons += ' <a href="'+ _publicUrl+'appointment/'+row.id+'/confirmChecked/1' +'"'; 
                            strButtons += ' data-id="'+row.id+'"';
                            strButtons += ` class="ml-1 primary acceptAppointment" data-toggle="tooltip" data-placement="top" title="@lang('messages.accept_kinda_appointment')">`;
                            strButtons += ' <i class="fa fa-check"></i></a>'; 
                            
                            strButtons += ' <a href="'+ _publicUrl+'appointment/'+row.id+'/confirmChecked/2' +'"'; 
                            strButtons += ' data-id="'+row.id+'"';
                            strButtons += ` class="ml-1 primary rejectAppointment" data-toggle="tooltip" data-placement="top" title="@lang('messages.reject_kinda_appointment')">`;
                            strButtons += ' <i class="fa fa-times"></i></a>';  
                        @endif
                        if (row.comments){
                            strButtons += ' <a href="'+ _publicUrl+'appointment/'+row.id+'/comments' +'"'; 
                            strButtons += ' data-id="'+row.id+'"';
                            strButtons += ` class="ml-1 primary" data-toggle="tooltip" data-placement="top" title="@lang('messages.view_comments')">`;
                            strButtons += ' <i class="fa fa-eye"></i></a>';
                        }
                        
                        strButtons += ' <a href="'+ _publicUrl+'appointment/'+row.id+'/edit' +'"'; 
                        strButtons += ' data-id="'+row.id+'"';
                        strButtons += ` class="ml-1 primary" data-toggle="tooltip" data-placement="top" title="@lang('messages.edit_stat')">`;
                        strButtons += ' <i class="fa fa-edit"></i></a>'; 
                        strButtons += ' <a href="'+ _publicUrl+'appointment/'+row.id+'/confirmDelete' +'"'; 
                        strButtons += ' data-id="'+row.id+'"';
                        strButtons += ` class="ml-1 danger deleteAppointment" data-toggle="tooltip" data-placement="top" title="@lang('messages.delete_stat')">`;
                        strButtons += ' <i class="fa fa-trash"></i></a>'; 
                        @endif
                    strButtons += ' </div>'; 

                    return strButtons;
                    
                }
            }
          ],
          "fnDrawCallback": function( oSettings ) {
            
            $('.acceptAppointment').on('click', function(e){
                e.preventDefault();

                showModal(_questionMarkSpConcat+"@lang('messages.reject_kinda_appointment')"+' '+ $(this).data('id') + '?', $(this).data('id'), false, 
                $(this).attr('href'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 
            });
            $('.rejectAppointment').on('click', function(e){
                e.preventDefault();

                showModal(_questionMarkSpConcat+"@lang('messages.reject_kinda_appointment')"+' '+ $(this).data('id') + '?', $(this).data('id'), false, 
                $(this).attr('href'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 
            });
            $('.deleteAppointment').on('click', function(e){
                e.preventDefault();

                showModal(_questionMarkSpConcat+"@lang('messages.delete_kinda_appointment')"+' '+ $(this).data('id') + '?', $(this).data('id'), false, 
                $(this).attr('href'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 
            });
          }
      }).on('draw', () => {
        disableDataTablesMinCharactersSearch('#mainTableAllAppointments', 3, true);
        assignHeadersToRowsResponsive();
      });
      

</script>
@endsection
