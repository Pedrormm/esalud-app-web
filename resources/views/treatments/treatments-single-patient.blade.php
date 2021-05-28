
@section('scriptsPropios')

<script>
    $('.cHeader button').on('click', function(e){
        e.preventDefault();
        window.location.href = PublicURL+"treatments/";
    });

    let _mainTableAllUsersAjax = $('#TableTreatmentsSinglePatient').DataTable({
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
              url: PublicURL + 'treatments/singlePatient/'+{{ $userId }}+'/viewDT',
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
            {
                data: '_create',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-primary confirmDeleteTreatment"';
                    // strButtons += ' href="">';  
                    strButtons += ' href="'+ PublicURL+'treatments/'+row.id+'/edit' +'">'; 
                    strButtons += ' <i class="fa fa-edit"></i>&ensp;Editar</a></span>';                                                                                                  
                    return strButtons;
                }
            },
            {
                data: '_edit',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-info confirmDeleteTreatment"';
                    strButtons += ' href="'+ PublicURL+'treatments/'+row.users_id+'/indexSinglePatient' +'">';  
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
                    strButtons += ' href="">';  
                    strButtons += ' <i class="fa fa-trash"></i>&ensp;Eliminar</a></span>';                                                                                                  
                    return strButtons;
                }
            },
          ],
          "fnDrawCallback": function( oSettings ) {

          }
      }).on('draw', () => {
          console.log("entra draw");
          disableDataTablesMinCharactersSearch('#TableTreatmentsSinglePatient', 3, true);
          assignHeadersToRowsResponsive();
      });
      






</script>
@endsection