
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
            {
                data: '_create',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-primary confirmDeleteTreatment"';
                    // strButtons += ' href="">';  
                    strButtons += ' href="'+ _publicUrl+'treatments/'+row.id+'/edit' +'">'; 
                    strButtons += ' <i class="fa fa-edit"></i>&ensp;';
                    strButtons += _messagesLocalization.edit_stat+'</a></span>';                                                                                                  
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
                    strButtons += ' href="'+ _publicUrl+'treatments/'+row.users_id+'/indexSinglePatient' +'">';  
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
                    strButtons += ' href="">';  
                    strButtons += ' <i class="fa fa-trash"></i>&ensp;';
                    strButtons += _messagesLocalization.delete_stat+'</a></span>';                                                                                                  
                    return strButtons;
                }
            },
          ],
          "fnDrawCallback": function( oSettings ) {

          }
      }).on('draw', () => {
        //   console.log("entra draw");
          disableDataTablesMinCharactersSearch('#TableTreatmentsSinglePatient', 3, true);
          assignHeadersToRowsResponsive();
      });
      






</script>
@endsection
