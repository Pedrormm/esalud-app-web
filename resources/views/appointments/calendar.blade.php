@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('viewsScripts')
    <script type="text/javascript">
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

          locale: getLanguageDtFormat(_lang),

          initialView: 'dayGridMonth',
            @if($rol_user == \HV_ROLES::ADMIN)
                // editable: true,
            @endif
        //   headerToolbar: {
        //         left: 'prev,next today',
        //         center: 'title',
        //         right: 'month,agendaWeek,agendaDay'
        //     },
          events: [
            //   {title:'prueba', start:'2021-03-03T10:30:00'},
                @foreach($appointments as $appointment)
                    {
                        @if($rol_user == \HV_ROLES::PATIENT)
                            
                            title: "@lang('messages.doctor_type')"+": {{ $appointment->fullNameDoctor }}",
                            description: '{{  $appointment->id }}',
                            // start: '{{ date("Y-m-d",strtotime($appointment->dt_appointment)) }}',
                            start: '{{ date("Y-m-d\TH:i",strtotime($appointment->dt_appointment)) }}',
                            // start: "2021-03-03T10:30:00"
                            color: 'red',
                            textColor: '#ffffff',
                            allDay: false

                        @elseif($rol_user == \HV_ROLES::DOCTOR)
                            
                            title: "@lang('messages.patient_type')"+": {{ $appointment->fullNamePatient }}",
                            description: '{{  $appointment->id }}',
                            // start: '{{ date("Y-m-d",strtotime($appointment->dt_appointment)) }}',
                            start: '{{ date("Y-m-d\TH:i",strtotime($appointment->dt_appointment)) }}',
                            color: 'blue',
                            textColor: '#ffffff',
                            allDay: false

                        @elseif($rol_user == \HV_ROLES::ADMIN)
                            
                            title: "@lang('messages.patient_type')"+": {{ $appointment->fullNamePatient }}",
                            description: '{{  $appointment->id }}',
                            // start: '{{ date("Y-m-d",strtotime($appointment->dt_appointment)) }}',
                            start: '{{ date("Y-m-d\TH:i",strtotime($appointment->dt_appointment)) }}',
                            // start: "2021-03-03T10:30:00",
                            color: 'green',
                            textColor: '#ffffff',
                            allDay: false

                        @endif
                        
                    },
                @endforeach
            ],            
            eventClick: function(info) {               
                showModal(info.event.title, '', false, _publicUrl + "appointment/showCalendar/"+ info.event._def.extendedProps.description, 'modal-xl',
                true, true, false);                 
            } 
        });
        calendar.render();
      });

  </script>
@endsection