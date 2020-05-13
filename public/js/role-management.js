$.fn.dataTable.ext.errMode = 'throw';
let _mainDataTableRoles = $('#mainTableRoles').DataTable({
  
  "responsive": true,
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
  },

  ajax: {
        // For the 419 unknown laravel status:
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: PublicURL + 'public/roles/view',
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
            // "render": function ( data, type, row ) {
            //   return row.nameRole;
            // },
            "targets": 0,
            'createdCell':  function (td, cellData, rowData, row, col) {
                //console.log("Yo toy el td", td, "con cellData", cellData, "rowData=", rowData, "row=", row, "y col=", col);
                $(td).data('role-id', rowData.idRole); 
            },
            
        },
        {
            "render": function ( data, type, row ) {
                return     '<a href="'+PublicURL+'public/role/userManagement/edit/'+row.idRole+'"' + 
                            ' class="btn btn-primary role-users-modal" data-name-role="' + row.nameRole + 
                            '" data-role-id="'+ row.idRole +'" role="button">'+
                            'Usuarios asociados' +
                            '</a>'
            },
            "targets": 1
        },
        {
            "render": function ( data, type, row ) {
                return     '<a href="'+PublicURL+'public/user/roleManagement/edit/'+row.idRole+'"' + 
                            ' class="btn btn-primary role-modal" data-name-role="' + row.nameRole + 
                            '" data-role-id="'+ row.idRole +'" role="button">'+
                            'Editar' +
                            '</a>'
            },
            "targets": 4
        },
        {
            "render": function ( data, type, row ) {
                return     '<a href="'+PublicURL+'public/role/delete/'+row.idRole+'"' + 'id="roleDelete"'+
                            ' class="btn btn-danger" data-name-role="' + row.nameRole + 
                            '" data-role-id="'+ row.idRole +'" role="button">'+
                            '<i class="fa fa-trash"></i>&ensp;Borrar' +
                            '</a>'
            },
            "targets": 5
        },
    ],

    "fnDrawCallback": function( oSettings ) {
        $('.role-modal').on('click', function(e){
            e.preventDefault();
            showModal('Editar rol '+ $(this).data('name-role'), '', false, $(this).attr('href'), 'modal-xl', true, true); 
        });
    }


});


$('#usersDistRole').on('click', function(e){
    e.preventDefault();
    showModal('Crear nuevo rol ', '', false, $(this).attr('href'), 'modal-xl', true, true); 
});
