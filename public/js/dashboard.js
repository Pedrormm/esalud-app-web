// var ctx = document.getElementById('usersChart').getContext('2d');
// var chart = new Chart(ctx, {
//     // The type of chart we want to create
//     type: 'line',

//     // The data for our dataset
//     data: {
//         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//         datasets: [{
//             label: 'My First dataset',
//             backgroundColor: 'rgb(255, 99, 132)',
//             borderColor: 'rgb(255, 99, 132)',
//             data: [0, 10, 5, 2, 20, 30, 45]
//         }]
//     },

//     // Configuration options go here
//     options: {}
// });

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


$.ajax(PublicURL + 'dashboard/fillMsgTable', {
    dataType: 'json',
    method:'get',
}).done(function(res){
  $('#msgTable').find('tr:gt(0)').remove();
  let tbody = createMsgTableTBody(res);
  $(tbody).insertAfter('#msgTable thead');
})
.fail(function(xhr, st, err) {
    console.error("error in messaging/updateReadMessages " + xhr, st, err);
}); 


// <table class="table table-striped">
//                                   <thead>
//                                       <tr>
//                                           <th> Role </th>
//                                           <th> Porcentaje de mensajes enviados </th>
//                                           <th> Número de mensajes enviados </th>
//                                           {{-- <th> Número de mensajes recibidos </th> --}}
//                                       </tr>
//                                   </thead>
//                                   </table>
//                                   <tbody>
//                                       <tr>
//                                           <td> Admin </td>
//                                           <td>
//                                               <div class="progress">
//                                                 <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
//                                               </div>
//                                           </td>
//                                           <td> 20 </td>
//                                       </tr>
                                      
//                                   </tbody>
//                               </table>


var diaryAppointments = document.getElementById('diaryAppointments').getContext('2d');
var chart = new Chart(diaryAppointments, {
    // The type of chart we want to create
    type: 'doughnut',
    // The data for our dataset
    data: {
        datasets: [{
            data: [10, 20],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
              ],
        }],    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Pendientes',
            'Procesadas'    
        ]
    },
});

var laggardAppointments = document.getElementById('laggardAppointments').getContext('2d');
var chart = new Chart(laggardAppointments, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        datasets: [{
            data: [15, 20],
            backgroundColor: [
                'rgb(238, 130, 238)',
                'rgb(238, 238, 130)'
            ],
        }],    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Pendientes',
            'Procesadas'    
        ]
    },
});

var mostWeekAppointments = document.getElementById('mostWeekAppointments').getContext('2d');
var chart = new Chart(mostWeekAppointments, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
    data: {
        labels: weekNameDays,
        datasets: [{
          label: 'Números de cita por días de la semana',
          data: [65, 59, 80, 81, 56, 55, 40],
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

var usersTypeRoles = document.getElementById('usersTypeRoles').getContext('2d');
var chart = new Chart(usersTypeRoles, {
    // The type of chart we want to create
    type: 'polarArea',
    // The data for our dataset
    data: {
        labels: [
          'Patients',
          'Doctors',
          'Helpers',
          'Admins',
          'Guests'
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [11, 16, 7, 3, 14],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(75, 192, 192)',
            'rgb(255, 205, 86)',
            'rgb(201, 203, 207)',
            'rgb(54, 162, 235)'
          ]
        }]
      },
});

