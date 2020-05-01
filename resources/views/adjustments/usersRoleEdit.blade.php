<select id="users" class="selectpicker" data-live-search="true">
    <optgroup label="Picnic">
      <option>Mustard</option>
      <option>Ketchup</option>
      <option>Relish</option>
    </optgroup>
    <optgroup label="Camping">
      <option>Tent</option>
      <option>Flashlight</option>
      <option>Toilet Paper</option>
    </optgroup>
  </select>  




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead class="text-center">
        <tr>
          <th>Nombre de usuario</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
</div>

<script>
    var populateMultiselect = function(dataurl,ids,role_id){

      var soptions = {
        ajax: {
            url: dataurl,
            type: 'POST',
            dataType: 'json',
            // Use "{@{{q}}}" as a placeholder and Ajax Bootstrap Select will
            // automatically replace it with the value of the search query.
            data: {
                role_id:role_id,
                q: '{@{{q}}}'
            }
        },   
        log: 3,
        /*preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for(i = 0; i < l; i++){
                    array.push($.extend(true, data[i], {
                        text: data[i].Name,
                        value: data[i].Id,
                        data: {
                            subtext: data[i].Rut+', '+data[i].Email
                        }
                    }));
                }
            }
            // You must always return a valid array when processing data. The
            // data argument passed is a clone and cannot be modified directly.

            return array;

        }*/
        
      }
      $(ids).selectpicker().ajaxSelectPicker(soptions);
    }
  //  $(".selectpicker").selectpicker();
   
   populateMultiselect('{{ URL::asset('/role/userManagement/edit/1')  }}','#users');
</script>