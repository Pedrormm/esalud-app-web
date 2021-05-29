
@section('viewsScripts')

<script>



    let _mainTableAllUsersAjax = $('#mainTableStaff').DataTable({
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
              url: _publicUrl + 'staff/viewDT',
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
                    console.log("DATOS "+ data, type, row);
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
                data: 'role_name',            
            },
            {
                data: 'historic',
            },
            {
                data: 'branch_name',
            },
            {
                data: 'shift',

                render: function(data, type, row) {
                    let strShift = "";

                    strShift += '<span class="align-middle">';
                    switch(row.shift) {
                        case "M":
                            strShift += 'Mañana';
                            break;
                        case "ME":
                            strShift += 'Mañana y Tarde';
                            break;
                        case "MN":
                            strShift += 'Mañana y Noche';
                            break;
                        case "MEN":
                            strShift += 'Mañana, Tarde y Noche';
                            break;
                        case "E":
                            strShift += 'Tarde';
                            break;
                        case "EN":
                            strShift += 'Tarde y Noche';
                            break;
                        case "N":
                            strShift += 'Noche';
                            break;
                        default:
                            strShift += ' ';
                    }
                    strShift += '</span>';


                    return strShift;
                }
            },
            {
                data: 'office',
            },
            {
                data: 'room',
            },
            {
                data: 'h_phone',
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
                data: 'phone',
            },
            {
                data: 'sex',
            },
            {
                data: '_buttons',
                orderable: false,
                render: function(data, type, row) {
                    console.log(data, type, row);
                    let strButtons = "";

                    @if(isset($flagsMenuEnabled['STAFF_USER_EDIT']) && $flagsMenuEnabled['STAFF_USER_EDIT'])
                        strButtons += '<span><a href="'+ _publicUrl+'staff/'+row.users_id+'/edit' +'"><i class="fa fa-edit"></i></a></span>';                                                                           
                    @else
                        strButtons += '<span><i class="fa fa-edit" style="color:gray"></i></span>';                                                                           
                    @endif    
                    @if(isset($flagsMenuEnabled['STAFF_USER_DELETE']) && $flagsMenuEnabled['STAFF_USER_DELETE'])

                        strButtons += ' <span> <a class="confirmDeleteUser"';
                        strButtons += ' data-name-user="'+row.name + ' '+ row.lastname+'" ';
                        strButtons += ' data-role-user="'+row.role_name+'"';
                        strButtons += ' data-id-user="'+row.users_id +'"';
                        strButtons += ' href="'+ _publicUrl+'staff/'+row.users_id+'/confirmDelete' +'">';  
                        strButtons += ' <i class="fa fa-trash"></i></a></span>';                                                                                                  
 
                    @else
                        strButtons += ' <span><i class="fa fa-trash" style="color:gray"></i></span> ';
                        
                    @endif  

                    return strButtons;
                }
            }
          ],
          "fnDrawCallback": function( oSettings ) {
            $('.confirmDeleteUser').on('click', function(e){
                e.preventDefault();
                let userDeleteId = $(this).data('id-user');
                let userDeleteFullName = $(this).data('name-user');
                let userDeleteRole = $(this).data('role-user');

                showModal('¿Borrar usuario '+ userDeleteFullName + '?', 
                '¿Seguro que desea borrar el usuario con nombre '+ userDeleteFullName + ' y rol '+ userDeleteRole + '?',
                false, $(this).data('link'), 'modal-xl', true, true, false, null, null, "No", "Sí"); 

                $('#saveModal').on('click', function(e){
                    saveModalActionAjax(_publicUrl+"staff/"+userDeleteId, userDeleteId, 'DELETE', 'json', function(res) {
                        if(res.status == 0) {
                            $('#mainTableStaff').DataTable().ajax.reload();
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
          console.log("entra draw");
          disableDataTablesMinCharactersSearch('#mainTableStaff', 3, true);
          assignHeadersToRowsResponsive();
      });
      






</script>
@endsection
