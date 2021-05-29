
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
                    strButtons += ' href="'+ _publicUrl+'treatments/'+row.users_id+'/indexSinglePatient' +'">'; 
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
        disableDataTablesMinCharactersSearch('#mainTablePatientsTreatments', 3, true);
        assignHeadersToRowsResponsive();
      });
      






</script>
@endsection
