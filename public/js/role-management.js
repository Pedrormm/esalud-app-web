$.fn.dataTable.ext.errMode = 'throw';

let _mainDataTableRoles = $('#mainTableRoles').DataTable({
  
  "responsive": true,
  "language": {
    "url": _urlDtLang
  },

  ajax: {
        // For the 419 unknown laravel status:
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: _publicUrl + 'roles/viewDT',
        method: "POST",
        dataSrc: "data",
        xhrFields: {
            withCredentials: true
        }
    },

  columns : [
        { "data" : "nameRole" },
        {  },
        { "data" : "dni" },
        { "data" : "count" },
        {  },
        {  },
    ],

  columnDefs: [
        {
            "targets": 0,
            'createdCell':  function (td, cellData, rowData, row, col) {
                //console.log("Yo toy el td", td, "con cellData", cellData, "rowData=", rowData, "row=", row, "y col=", col);
                $(td).data('role-id', rowData.idRole); 
            },
            
        },
        {
            "render": function ( data, type, row ) {
                return     '<a href="'+_publicUrl+'roles/userManagement/edit/'+row.idRole+'"' + 
                            ' class="btn btn-primary role-users-modal" data-name-role="' + row.nameRole + 
                            '" data-role-id="'+ row.idRole +'" role="button">'+
                            _messagesLocalization.associated_users +
                            '</a>'
            },
            "targets": 1
        },
        {
            "render": function ( data, type, row ) {
                // return     '<a href="'+_publicUrl+'user/roleManagement/edit/'+row.idRole+'"' + 
                return     '<a href="'+_publicUrl+'roles/'+row.idRole+'/edit/'+'"' + 
                            ' class="btn btn-primary role-modal" data-name-role="' + row.nameRole + 
                            '" data-role-id="'+ row.idRole +'" role="button">'+
                            _messagesLocalization.edit_stat +
                            '</a>'
            },
            "targets": 4
        },
        {
            "render": function ( data, type, row ) {
                // return     '<a href="'+_publicUrl+'role/confirmDelete/'+row.idRole+'"' + 'id="roleDelete"'+
                var isDisabled = row.delible == 1 ? " isDisabled" : "";
                return     '<a href="'+_publicUrl+'roles/'+row.idRole+'/confirmDelete/'+'"' + 
                            ' class=\"btn btn-danger roleDelete' +isDisabled+'\"'+
                            ' data-name-role="' + row.nameRole + 
                            '" data-role-id="'+ row.idRole +'" role="button">'+
                            '<i class="fa fa-trash"></i>&ensp;' +
                            _messagesLocalization.delete_stat+'</a>'
            },
            "targets": 5
        },
        {
            "render": function ( data, type, row ) {
                // console.log("fila es",row);
                // console.log("data es",data);
                // console.log("type es",type);
               
                var parseWithHeaderColumnHidden = (data) => {
                    return '<table><tr><td class="header-toggle-hidden">'+ row.parent.child(0).innerText +'</td><td>'+data+'</td></tr></table>';
                };
                return  parseWithHeaderColumnHidden(row.nameRole);
            },
            "targets": 1
        }
    ],

    "fnDrawCallback": function( oSettings ) {
        $('.role-modal').on('click', function(e){
            e.preventDefault();
            showModal(_messagesLocalization.edit_stat_role+' '+ $(this).data('name-role'), '', false, $(this).attr('href'), 'modal-xl', true, true); 
        });

        $('.roleDelete').on('click', function(e){
            e.preventDefault();
            
            // showModal(_messagesLocalization.would_you_like_to_delete_the_role+' '+ $(this).data('name-role') + '?', $(this).data('name-role'), false, 
            // $(this).attr('href'), 'modal-xl', true, true); 

            showModal(_messagesLocalization.would_you_like_to_delete_the_role+' '+ $(this).data('name-role') + '?', $(this).data('name-role'), false, 
            $(this).attr('href'), 'modal-xl', true, true, false, null, null, _messagesLocalization.no_response, _messagesLocalization.yes_response); 
        });
    }
}).on('draw', () => {
    // console.log("entra draw");
    assignHeadersToRowsResponsive();
});


$('#usersDistRole').on('click', function(e){
    e.preventDefault();
    showModal(_messagesLocalization.create_stat_new_role+' ', '', false, $(this).attr('href'), 'modal-xl', true, true);
    $( this ).off( event ); 
});
