
    let active = false;
    let minutesPerDate = 30;

    let today = new Date();
    let tomorrow = new Date(today.getTime()+1000*60*60*24);

    let dd = tomorrow.getDate();
    let mm = tomorrow.getMonth()+1; //January is 0
    let yyyy = tomorrow.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

    tomorrow = yyyy+'-'+mm+'-'+dd;
    // console.log(tomorrow);
    document.getElementById("dt_appointment").setAttribute("min", tomorrow);
    let $myForm = $('#createAppointmentForm')

    $('#patient').on('change', function (e) {      
      let valueSelected = this.value;
      showAndHideValidationMessage(valueSelected, '#patientValidity', $myForm);
    });

    $('#doctor').on('change', function (e) {
      let valueSelected = this.value;
      showAndHideValidationMessage(valueSelected, '#doctorValidity', $myForm);
    });


    $('#showAppointmentsButton').on("click",function(e){

        if (!$myForm[0].checkValidity()) {
            // Invalid
            let pat =  $('#patient');
            showAndHideValidationMessage(pat.val(), '#patientValidity', $myForm);
            let doc =  $('#doctor');
            showAndHideValidationMessage(doc.val(), '#doctorValidity', $myForm);
            let dtAppointment = $("#dt_appointment");
            showAndHideValidationMessage(dtAppointment.val(), '#dateValidity', $myForm);
        }
        else{
            // Valid
            if ($( "#patientValidity" ).length) {
                $( "#patientValidity").remove();
            }
            if ($( "#doctorValidity" ).length) {
              $( "#doctorValidity").remove();
            }
            if ($( "#dateValidity" ).length) {
              $( "#dateValidity").remove();
            }
            if ($( "#appointmentsSchedule" ).length) {
                $( "#appointmentsSchedule").remove();
            }

            let fullDate = getDateFromDateTimeFormatted($('#dt_appointment').val());
            // console.log("date "+ fullDate);
            let doctorId = $('#doctor').val();
            // console.log("doctorId ",doctorId);
            // console.log("value ", doctorId);
            callSch(fullDate,doctorId);
        }

    });

    $('#createButton').on("click",function(e){
        e.preventDefault();
        let time = $(".hv-time-selected").attr("data-hour");
        let dt = $(".hv-time-selected").attr("data-date");
        let dtime = dt + " " + time + ":00";

        console.log("el datime es ",dtime);
        // let date = new Date(dtime);
        // console.log(date);
        let  input = $('<input>').attr("type","hidden").attr("name","dtime").attr("id","dtime").attr("value",dtime);
        input.appendTo( "#createAppointmentForm" );
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url:_publicUrl+'appointment',
            method:"POST",
            // data: {"data":$("#createAppointmentForm").serialize(),"_method":'PUT'},
            data: $("#createAppointmentForm").serialize(),
            dataType:"json",
            contenttype: "application/json; charset=utf-8",
        }).done(function(response){
            // console.log("resp ", response);
            showInlineMessage(response.message, 30);
            // console.log("app ",response.obj);

        });
    });

    /**
     * Calls the appointment/realDoctorSchedule endpoint so the staff schedule will be known
     * @author Pedro Ramón Moreno Martín <pedroramonmm@gmail.com>
     * @param {date} date - The date of the doctor schedule to be looked for int the appointments
     * @param {number} doctorId - The doctor id to be looked for.
     * @return {void} Nothing
     */
    function callSch(date, doctorId) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url:_publicUrl+'appointment/realDoctorSchedule',
            type:"GET",
            data: {"date":date,"doctorId":doctorId},
            dataType:"json",
            contenttype: "application/json; charset=utf-8",
        }).done(function(response){
            createAppointmentsScheduleTable(response, date);
        });
    }

    function showAndHideValidationMessage(selector, idSelector, form){
      if (!(selector)){
        form.addClass('was-validated');
        $(idSelector).show();
      }
      else{
        form.removeClass('was-validated');
        $(idSelector).hide();
      }
    }

    function mouseOverOutBackground(){
        $("#appointmentsSchedule").on('mouseover', 'div', function(e) {
            if (($(e.target).hasClass('hv-time-selection-active')) && (!$(e.target).hasClass("hv-time-selected")))  {
                $(e.target).addClass('color-selection-active');
            }
        });
        $("#appointmentsSchedule").on('mouseleave mouseout', 'div', function(e) {
            if (($(e.target).hasClass('hv-time-selection-active')) && (!$(e.target).hasClass("hv-time-selected")))  {
                $(e.target).removeClass('color-selection-active');
            }
        });
    }

    function getDateFromDateTimeFormatted(dt) {
        let date = new Date(dt);
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        let fullDate = year +"-"+month+"-"+day;
        return fullDate;
    }
   
    function bindingSelection(date){
        $('.hv-time-selection-active:not(.hv-time-selection-occupied):not(.hv-time-selected)').on("click",function(e){
            if (!active){
                let dataDay = $(this).parent("div").attr("data-day");
                let finalDateTime = addDays(getMondayDate(date), parseInt(dataDay)-1);
                let finalDate = getDateFromDateTimeFormatted(finalDateTime);
                $(this).addClass("hv-time-selected").attr('data-date',finalDate);
                $('#createButton').show();
                active = true;
                if ($( ".hv-time-selected" ).length) {
                    $('.hv-time-selection-active:not(.hv-time-selected)').addClass('cursorNotAllowed');
                    if ($( ".hv-time-selection-active" ).hasClass('cursorNotAllowed')) {
                        $('.color-selection-active').removeClass('color-selection-active');
                        $("#appointmentsSchedule").off('mouseover mouseenter mouseleave mouseout');
                    }
                }

                $('.hv-time-selected').off().on("click",function(e){
                    if (active){
                        $(this).removeClass("hv-time-selected");
                        active = false;
                        $('.hv-time-selection-active').removeClass('cursorNotAllowed');
                        $('#createButton').hide();
                        mouseOverOutBackground();
                        bindingSelection(date);
                    }
                });
            }
        });

    }

    function fillCells(appointments, occupied, date){
        let continueDate = false;
        let currentWeek = false;
        let today = new Date();
        let tomorrow = new Date(today.getTime()+1000*60*60*24);
        let parsedGivenDate = new Date(date.replace("-","/"));
        // console.log("parsedGivenDate ",parsedGivenDate);
        // console.log(getWeekNumber(parsedGivenDate), getWeekNumber(today));  
        let givenDateWeek = getWeekNumber(parsedGivenDate);
        let todayWeek = getWeekNumber(tomorrow);
        let todayWeekDay = null;
        if ((givenDateWeek[0] >= todayWeek[0]) && (givenDateWeek[1] > todayWeek[1])){
            continueDate = true;
        }
        else if ((givenDateWeek[0] == todayWeek[0]) && (givenDateWeek[1] == todayWeek[1])){
            continueDate = true;
            todayWeekDay = getWeekDayDate(tomorrow);
            currentWeek = true;
        }

        if (continueDate){
            $.each(appointments, function(index, dayAps) {
            if ((currentWeek && todayWeekDay <= index) || !currentWeek){
                dayAps.forEach(function(ap) {
                    let occupiedDayHours = occupied[index];
                    // console.log("occupiedDay ",occupiedDayHours,ap);
                    if(ap.length != 2)
                        return false;
                    let startHour = ap[0];
                    let endHour = ap[1];
                    let startHourParts = startHour.split(":");
                    let endHourParts = endHour.split(":");
                    for(let i=startHourParts[0]; i<=endHourParts[0]; i++) {
                        let houri = (i+"").padStart(2, '0');
                        for(let j=0; j<31; j+=30) {
                            if(i == endHourParts[0] && endHourParts[1] < 30)
                                break;
                            let minutej = (j+"").padStart(2, '0');
                            let selector = 'div[data-day="'+ index +'"]>span[data-hour="'+ houri +':'+ minutej +'"]';
                            // console.log("selector interval", selector);
                            $(selector).addClass("hv-time-selection-active");
                            if (typeof occupiedDayHours !== "undefined"){
                                occupiedDayHours.forEach(function(oc){
                                    let ocParts = oc[0].split(":");
                                    if ((ocParts[0]== houri) && (ocParts[1] == minutej)){
                                        $(selector).addClass("hv-time-selection-occupied");
                                        // console.log("selector ", selector);
                                    }
                                })
                            }                      
                        }
                    }
                });   
            }        
        });
        mouseOverOutBackground();
        bindingSelection(date); 

        }

    }

    function addDays(date, days) {
        let copy = new Date((date));
        // console.log("copy ",copy);
        copy.setDate(date.getDate() + days);
        return copy;
    }

    function getMondayDate(date) {
        let dt = new Date(date);
        let day = dt.getDay();
        if(dt.getDay() == 0){
            dt.setDate(dt.getDate() - 6);
        }
        else{
            dt.setDate(dt.getDate() - (day-1));
        }
        return dt;
    }

    function getWeekDayDate(date) {
        let dt = new Date(date);
        let day = dt.getDay();
        day = day==0?7:day;
        return day;
    }

    function getWeekNumber(d) {
        // Copy date so don't modify original
        d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
        // Set to nearest Thursday: current date + 4 - current day number
        // Make Sunday's day number 7
        d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
        // Get first day of year
        var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
        // Calculate full weeks to nearest Thursday
        var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
        // Return array of year and week number
        return [d.getUTCFullYear(), weekNo];
    }

    function createAppointmentsScheduleTable(res, date){
        let buttonFound = $('#showAppointmentsButton');
        if (buttonFound[0]){
            // let weekNameDays = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
            let appointmentsSchedule = $('<div />').addClass("card-body").attr('id', 'appointmentsSchedule');
            let hvSchedule = $('<div />').addClass("hv-schedule");
            let hvHeader = $('<div />').addClass("hv-header");
            hvHeader = hvHeader.append($('<div />').text(""));
            _weekNameDays.forEach(function(d,index) {
                let dayNumber = addDays(getMondayDate(date), index).getDate().toString();
                // console.log("dia ", dayNumber);
                let day = $('<div />').text(d + " " + dayNumber);
                hvHeader = hvHeader.append(day);    
            });
            let hvHours = $('<div />').addClass("hv-hours");
            for (let i = 0; i < 24; i++) { 
                let hvRow = $('<div />').addClass("hv-row");
                let hvTimeCaption = $('<div />').addClass("hv-time-caption").append($('<span />').text((i+"").padStart(2,'0')+":00"));
                hvRow = hvRow.append(hvTimeCaption);
                let hvTimeSelection = "";
                if (minutesPerDate == 30){
                    for (let j = 1; j < 8; j++) { 
                        let customFirstHour = (i+"").padStart(2,'0')+":00";
                        let customSecondHour =  (i+"").padStart(2,'0')+":30";
                        let hvFirstHalf = $('<span />').addClass("hv-time-selection hv-half hv-first-half").attr('data-hour', customFirstHour)
                        .attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title', customFirstHour);
                        let hvSecondHalf = $('<span />').addClass("hv-time-selection hv-half hv-second-half").attr('data-hour', customSecondHour)
                        .attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title', customSecondHour);
                        hvTimeSelection = $('<div />').attr('data-day', j).append(hvFirstHalf).append(hvSecondHalf);
                        hvRow = hvRow.append(hvTimeSelection);
                    }
                }
                else if (minutesPerDate == 60){
                    for (let j = 1; j < 8; j++) { 
                        hvTimeSelection = $('<div />').addClass("hv-time-selection").attr('data-day', j).attr('data-hour', (i+"").padStart(2,'0')+":00");
                        hvRow = hvRow.append(hvTimeSelection);
                    }
                }
                hvHours = hvHours.append(hvRow);
            }
            appointmentsSchedule.append(hvSchedule.append(hvHeader).append(hvHours)).insertAfter(buttonFound);
        }
        fillCells(res[0],res[1],date);
    }
        