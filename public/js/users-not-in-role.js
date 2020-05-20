$('#saveModal').click(function() {  
  saveModalActionAjax($('#urlNotInRole').val(), _rolesForChange, 'POST', 'json', function(res) {
    if(res.status == 0) {
      $('#tableRoles').DataTable().ajax.reload();
      showInlineMessage(res.message, 20);
    }
    else {
      showInlineError(res.status, res.message, 5);
    }
    $('#saveModal').off("click");
  });

});

  $("#userspicker").selectpicker();
  
  var t = $('#tableUsersNotInRole');
  
  $('#userspicker').change(function (event) {
    t = $('#tableUsersNotInRole').DataTable( {
        "responsive": true,
        // "scrollY": 550,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
    } ).on( 'page.dt', function() {
        setTimeout(refreshPickers, 1);
        
    });
    $("#tableUsersNotInRole").css("display", "table");
  
    $( this ).off( event );
  });
  $('#userspicker').change(function () {
    var selectedItems = $('#userspicker').val();
    // console.log(selectedItems);
    _rolesForChange = {};

  
    t.clear().draw();
    // Delete everything beforehand
    if (selectedItems[0]){
  
      
      selectedItems.forEach(function (item, index) {
        //Create a selectpicker list for last column
        let userId =  allUsers[item][0].id;
        // console.log("userID", userId);
        let roleSelector = $('<select>', {class: 'selectpicker show-tick selectOtherRole'});
  
        $.each(roles, (index, element) => {
          let opt = $('<option>').attr('value', element.id). text(element.name);
          if(element.name == allUsers[item][0].role.name) {
            // console.log("selected user role is ", allUsers[item][0].role.name);
            // console.log("checking roles is ", element.name);
            opt.attr('selected', true);
          }
          
          roleSelector.append(opt);
        });
        //roleSelector.data('user-id', userId);
        // console.log("...Added new select", roleSelector);

        let codeSelect = roleSelector[0].outerHTML;
        codeSelect = codeSelect.replace("<select ", "<select data-user-id=\"" + userId + "\" ");
        t.row.add( [
          item,
          allUsers[item][0]["name"] + " " + allUsers[item][0]["lastname"],
          allUsers[item][0]["dni"],
          getAge(allUsers[item][0]["birthdate"]) + " años",
          allUsers[item][0]["sex"],
          allUsers[item][0]["blood"],
          codeSelect
        ] ).draw( false );
      });
  
      refreshPickers();
    }
  });
  
  function refreshPickers() {
    let funcName = arguments.callee.name;
    // console.log("Called to ", funcName);
    let sel = $(".selectOtherRole");
    sel.data('width', '100%').data('live-search', true).data('style', 'btn-success').selectpicker();
    sel.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      let roleId = this.options[clickedIndex].value;
      let userId = $(this).data('user-id');
      _rolesForChange[userId] = parseInt(roleId); 
    });   
  }


 