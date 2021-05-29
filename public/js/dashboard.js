
function createMsgTableTBody(res){
      
      let tbody = $('<tbody>');
      
      $.each(res, function(rol,d) {
        let row = '<tr>'+
          '<td> '+rol+ '</td>'+
          '<td>'+
            '<div class="progress">'+
              `<div class="progress-bar" role="progressbar" style="width:${d.perc}%;" aria-valuenow="${d.perc}" aria-valuemin="0" aria-valuemax="100">${d.perc}</div>`+
            '</div>'+
          '</td>'+
          `<td> ${d.cnt} </td>`+
          '</tr>';
         
          tbody.append(row);
      });
      
      return tbody;
}

let pending = $("#diaryAppointments").data("pending");
let processed = $("#diaryAppointments").data("processed");

$.ajax(_publicUrl + 'dashboard/fillMsgTable', {
    dataType: 'json',
    method:'get',
}).done(function(res){
  $('#msgTable').find('tr:gt(0)').remove();
  let tbody = createMsgTableTBody(res);
  $(tbody).insertAfter('#msgTable thead');
})
.fail(function(xhr, st, err) {
    console.error("error in dashboard/fillMsgTable " + xhr, st, err);
}); 

$.ajax(_publicUrl + 'dashboard/fillDiaryAppointments', {
  dataType: 'json',
  method:'get',
}).done(function(res){

  let diaryAppointments = document.getElementById('diaryAppointments').getContext('2d');
  let chart = new Chart(diaryAppointments, {
      // The type of chart we want to create
      type: 'doughnut',
      // The data for our dataset
      data: {
          datasets: [{
              data: [res.pending, res.processed],

              backgroundColor: [
                  'rgb(255, 99, 132)',
                  'rgb(54, 162, 235)',
                ],
          }],    
          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: [
            pending,
            processed    
          ]
      },
  });

})
.fail(function(xhr, st, err) {
  console.error("error in dashboard/fillDiaryAppointments " + xhr, st, err);
}); 


$.ajax(_publicUrl + 'dashboard/fillDelayedAppointments', {
  dataType: 'json',
  method:'get',
}).done(function(res){

  let laggardAppointments = document.getElementById('laggardAppointments').getContext('2d');
  let chart = new Chart(laggardAppointments, {
      // The type of chart we want to create
      type: 'pie',
      // The data for our dataset
      data: {
          datasets: [{
              // data: [15, 20],
              data: [res.pending, res.processed],

              backgroundColor: [
                  'rgb(238, 130, 238)',
                  'rgb(238, 238, 130)'
              ],
          }],    
          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: [
              pending,
              processed    
          ]
      },
  });

})
.fail(function(xhr, st, err) {
  console.error("error in dashboard/fillDelayedAppointments " + xhr, st, err);
}); 


$.ajax(_publicUrl + 'dashboard/fillWeekAppointments', {
  dataType: 'json',
  method:'get',
}).done(function(res){
  let weekValue = res.map((week)=>week['value']);
  let weekName = res.map((week)=>week['weekName']);

  let mostWeekAppointments = document.getElementById('mostWeekAppointments').getContext('2d');
  let label = $("#mostWeekAppointments").data("label");
  let chart = new Chart(mostWeekAppointments, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
    data: {
        labels: weekName,
        datasets: [{
          label: label,
          data: weekValue,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }]
    },
});   

})
.fail(function(xhr, st, err) {
  console.error("error in dashboard/fillWeekAppointments " + xhr, st, err);
}); 



$.ajax(_publicUrl + 'dashboard/fillUsersTypeRoles', {
  dataType: 'json',
  method:'get',
}).done(function(res){
  // console.log(res);
  let roleNames = res.map((roles)=>roles['roles']['name']);
  let roleColors = res.map((roles)=>roles['color']);
  let roleTotals = res.map((roles)=>roles['total']);

  let usersTypeRoles = document.getElementById('usersTypeRoles').getContext('2d');
  let chart = new Chart(usersTypeRoles, {
      type: 'polarArea',
      data: {
          labels: roleNames,
          datasets: [{
            label: 'Existing roles',
            data: roleTotals,
            backgroundColor: roleColors
          }]
        },
  });

})
.fail(function(xhr, st, err) {
  console.error("error in dashboard/fillUsersTypeRoles " + xhr, st, err);
}); 
