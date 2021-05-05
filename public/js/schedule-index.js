
3
    $( "#SaveSchedule" ).on( "click", function() {
        // console.log( $( this ).text() );
        submit();
    });
      
      var model;
      $.ajax({
          async: false, 
          dataType: 'json',
          data: {},
          method:'GET',
          contentType: "application/json",
          url: PublicURL + 'schedule/generateSchedule',
      }).done(function(res){
          console.log("RESPU",res);
          if (res === false){
            console.log("falso");
            $('.hv-schedule').remove();
            $('#SaveSchedule').remove();
            showInlineMessage("No dispones de horario por no ser empleado", 60);
            $('#indexScheduleCard h4').text("No hay horario");
          }
          else{
            model = res;
            fillSchedule(null);
          }
      })
      .fail(function(xhr, st, err) {
          console.error("error in schedule/generateSchedule " + xhr, st, err);
      }); 

      function refresh(){
        fillSchedule(model);
      }
      function fillSchedule(){
        var hvHours = document.querySelector('.hv-hours');
        var minHour = 0;
        var maxHour = 23;
        var minDay = 1;
        var maxDay = 7;
        var pad = function (str, max) {
          str = str.toString();
          return str.length < max ? pad("0" + str, max) : str;
       };
        
        for(var hour = minHour; hour<=maxHour; hour++){
          var hourDiv =createTimeCaptionDiv(hour);

          for(var day = minDay; day<=maxDay; day++){
            // console.log('model',model);
           
            //var occupiedTime = model.find((m)=> checkValidDayHour(m, day, hour));
            var occupiedTime = model.find((m)=> {
              let startHour = parseInt(m.starting_workday_time.substring(0,2));
              let endingHour = parseInt(m.ending_workday_time.substring(0,2))-1;
              let weekday = m.weekday;
              // console.log("Comparing day", weekday, " hourinit", startHour, "hourend", endingHour, "day", weekday, "VS day", day, "hour", hour);
              return (day == weekday && (startHour<=hour && endingHour>=hour));
            });
             //console.log('hour',hour);
             //console.log('day',day);
            var selected = occupiedTime ?true:false;
            createHourDiv(hourDiv,hour,day,selected);
          }
        }

        
      }

      function createTimeCaptionDiv(hour){
        var hvHours = document.querySelector('.hv-hours');
        var hourDiv = document.createElement('div');
        hourDiv.classList.add('hv-row');
        var timeCaptionDiv  = document.createElement('div');
        timeCaptionDiv.classList.add('hv-time-caption');
        var timeCaptionSpan = document.createElement('span');
        timeCaptionSpan.innerText = hour + ':00';
        timeCaptionDiv.appendChild(timeCaptionSpan);
        hourDiv.appendChild(timeCaptionDiv);
        hvHours.appendChild(hourDiv);
        return hourDiv;
      }

      function submit(){
        var model = [];
        var data = function (start_hour,end_hour){
          this.start_hour = start_hour;
          this.end_hour = end_hour;
        };
        var selecteds = document.querySelectorAll('div.hv-time-selection-active');
        var start_hour = -1;
        var end_hour = -1;
       
        let days = [];

        for(var i = 0; i<7; i++){
          days.push([]);
          let daysDivs  = $('div.hv-time-selection-active[data-day="' + parseInt(i+1) + '"]');
          let consec = false;
          let hAnt = 0;
          let int = 0;
          daysDivs.each(function(ind, el) {
            let h = $(this).data('hour');
            // console.log("day", i, "hour", h);
            if(h > hAnt+1) {
              consec = false;
              // console.log("detected empty");
            }
            if(!consec) {
              hAnt = h;
              days[i].push([h.toString()+":00:00", null]);

              consec = true;              
            }
            
            days[i][days[i].length-1][1] = (h+1).toString()+":00:00";
            hAnt = h;
          
          });
        }
        // console.log("array: ",days);

        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }, 
          url:PublicURL+'schedule/saveSchedule',
          type:"POST",
          data: {"days":days,"_method":'PATCH'},
          dataType:"json",
          contenttype: "application/json; charset=utf-8",

        }).done(function(response){

            console.log("respuesta: ",response);
            if(response.status == 0) {
                showInlineMessage(response.message, 10);
            }
            else {
                showInlineError(response.status, response.message, 10);
            }

        });


        for(var i = 0; i<selecteds.length; i++){
          var selected = selecteds[i];
          var hour = selected.getAttribute('data-hour');
          var day = selected.getAttribute('data-day');
         // console.log("hour", hour, "day", day);
          if(start_hour == -1){
            start_hour = hour;
            end_hour = hour;
          }
          if (start_hour != -1 && start_hour + 1 == hour){
              end_hour = hour;
          } else {
              model.push(new data(start_hour,end_hour))
              start_hour = -1;
              end_hour = -1;
          }
        }
        console.log("model",model);
      }

      function createHourDiv(hourDiv,hour,weekday,selected){
        var selectionDiv  = document.createElement('div');
        selectionDiv.setAttribute('data-day',weekday);
        selectionDiv.setAttribute('data-hour',hour);
        selectionDiv.classList.add('hv-time-selection');
        if(selected){
          selectionDiv.classList.add('hv-time-selection-active');
        }
        selectionDiv.addEventListener('click', function(){
          this.classList.toggle('hv-time-selection-active');
        })
        hourDiv.appendChild(selectionDiv);
      }