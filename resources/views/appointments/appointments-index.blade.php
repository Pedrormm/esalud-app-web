
@section('scriptsPropios')

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
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
      
        ajax: {
              // For the 419 unknown laravel status:
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              url: PublicURL + 'appointment/viewDT',
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
            {
                data: 'patientFullName'
            },
            {
                data: 'doctorFullName',
            },
            {
                data: 'dt_appointment',
            },
            {
                data: 'checkedStatus',
            },
            {
                data: '_buttons',
                orderable: false,

                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <div class="d-flex justify-content-center">';                                          
                    @if((auth()->user()->role_id == \HV_ROLES::PATIENT) || (auth()->user()->role_id == \HV_ROLES::DOCTOR)
                    || (auth()->user()->role_id == \HV_ROLES::ADMIN))

                        strButtons += ' <a href="'+ PublicURL+'appointment/'+row.id+'/confirmChecked/1' +'"'; 
                        strButtons += ' data-id="'+row.id+'"';
                        strButtons += ' class="ml-1 primary acceptAppointment" data-toggle="tooltip" data-placement="top" title="Aceptar cita">';
                        strButtons += ' <i class="fa fa-check"></i></a>'; 
                        
                        strButtons += ' <a href="'+ PublicURL+'appointment/'+row.id+'/confirmChecked/2' +'"'; 
                        strButtons += ' data-id="'+row.id+'"';
                        strButtons += ' class="ml-1 primary rejectAppointment" data-toggle="tooltip" data-placement="top" title="Rechazar cita">';
                        strButtons += ' <i class="fa fa-times"></i></a>';  
                        if (row.comments){
                            strButtons += ' <a href="'+ PublicURL+'appointment/'+row.id+'/comments' +'"'; 
                            strButtons += ' data-id="'+row.id+'"';
                            strButtons += ' class="ml-1 primary" data-toggle="tooltip" data-placement="top" title="Ver comentario">';
                            strButtons += ' <i class="fa fa-eye"></i></a>';
                        }
                        
                        strButtons += ' <a href="'+ PublicURL+'appointment/'+row.id+'/edit' +'"'; 
                        strButtons += ' data-id="'+row.id+'"';
                        strButtons += ' class="ml-1 primary" data-toggle="tooltip" data-placement="top" title="Editar">';
                        strButtons += ' <i class="fa fa-edit"></i></a>'; 

                        strButtons += ' <a href="'+ PublicURL+'appointment/'+row.id+'/confirmDelete' +'"'; 
                        strButtons += ' data-id="'+row.id+'"';
                        strButtons += ' class="ml-1 danger" data-toggle="tooltip" data-placement="top" title="Eliminar">';
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

                showModal('¿Aceptar cita '+ $(this).data('id') + '?', $(this).data('id'), false, 
                $(this).attr('href'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 
            });
            $('.rejectAppointment').on('click', function(e){
                e.preventDefault();

                showModal('Rechazar cita '+ $(this).data('id') + '?', $(this).data('id'), false, 
                $(this).attr('href'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 
            });
          }
      }).on('draw', () => {
        disableDataTablesMinCharactersSearch('#mainTableAllAppointments', 3, true);
        assignHeadersToRowsResponsive();
      });
      






</script>
@endsection
