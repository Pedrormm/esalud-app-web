
@section('scriptsPropios')

<script>



    let _mainTableAllUsersAjax = $('#mainTablePatientsTreatments').DataTable({
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
              url: PublicURL + 'treatments/viewDT',
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
                data: 'blood',
            },
            {
                data: 'birthdate',
            },
            {
                data: 'sex'
            },
            {
                data: '_create',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-primary createTreatment"';
                    strButtons += ' href="">';  
                    strButtons += ' <i class="fa fa-plus-circle"></i>&ensp;Crear</a></span>';                                                                                                  
                    return strButtons;
                }
            },
            {
                data: '_edit',
                orderable: false,
                render: function(data, type, row) {
                    // console.log(data, type, row);
                    let strButtons = "";
                    strButtons += ' <span> <a class="btn btn-info viewTreatments"';
                    strButtons += ' data-id-user="'+row.users_id +'"'; 
                    // strButtons += ' href="">';  
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
                    strButtons += ' <i class="fa fa-trash"></i>&ensp;Eliminar todos</a></span>';                                                                                                  
                    return strButtons;
                }
            },
          ],
          "fnDrawCallback": function( oSettings ) {

          }
      }).on('draw', () => {
        // $('.viewTreatments').on('click', function(e){
        //     e.preventDefault();
        //     let userId = $(this).data('id-user');
        //     console.log(userId  );

        //     let formData = new FormData();
        //     formData.append("id", userId);
        //     console.log(formData);

        //     // Display the key/value pairs
        //     for (var pair of formData.entries()) {
        //         console.log(pair[0]+ ', ' + pair[1]); 
        //     }
        //     let request = new XMLHttpRequest();

        //     request.open("POST", PublicURL+"treatments/indexSinglePatient");
        //     request.send(formData);
        //     // window.location.href = PublicURL+"treatments/indexSinglePatient";
        // });
        disableDataTablesMinCharactersSearch('#mainTablePatientsTreatments', 3, true);
        assignHeadersToRowsResponsive();
      });
      






</script>
@endsection
