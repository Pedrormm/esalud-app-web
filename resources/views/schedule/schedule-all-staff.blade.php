
@section('scriptsPropios')

<script>


    $('#scheduleStaffTable').DataTable({
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
              url: PublicURL + 'schedule/viewDT',
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
                    strButtons += ' href="'+ PublicURL+'schedule/staff/'+row.users_id+'">'; 
                    strButtons += ' <i class="fa fa-eye"></i>&ensp;Ver</a></span>';                                                                                                  
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
                    strButtons += ' href="'+ PublicURL+'schedule/staff/'+row.users_id+'/confirmDelete' +'">';  
                    strButtons += ' <i class="fa fa-trash"></i>&ensp;Eliminar horario</a></span>';                                                                                                  
                    return strButtons;
                }
            },
          ],
          "fnDrawCallback": function( oSettings ) {
            $('.confirmDeleteTreatment').on('click', function(e){
                e.preventDefault();
                let scheduleDeleteId = $(this).data('id-user');
                let scheduleDeleteFullName = $(this).data('name-user');
                
                showModal('¿Borrar horarios del usuario '+ scheduleDeleteFullName + '?', 
                '¿Seguro que desea eliminar todos los horarios del usuario '+ scheduleDeleteFullName + '?',
                false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 

                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(PublicURL+"schedule/"+scheduleDeleteId, scheduleDeleteId, 'DELETE', 'json', function(res) {
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
