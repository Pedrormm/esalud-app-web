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

@section('scriptsPropios')
<script type="text/javascript">
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
            @if($rol_user == 4)
                // editable: true,n
            @endif
          header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
          events: [
                @foreach($appointments as $appointment)
                    {
                        @if($rol_user == 1)
                            
                            title: 'Docotr: {{ App\User::find($appointment->user_id_doctor)->name }} {{ App\User::find($appointment->user_id_doctor)->lastname }}',
                            description: '{{  $appointment->id }}',
                            // start: '{{ date("Y-m-d",strtotime($appointment->dt_appointment)) }}',
                            start: '{{ date("Y-m-d\TH:i",strtotime($appointment->dt_appointment)) }}',
                            color: 'red',
                            textColor: '#ffffff',
                            allDay: false

                        @elseif($rol_user == 2)
                            
                            title: 'Paciente: {{ App\User::find($appointment->user_id_patient)->name }} {{ App\User::find($appointment->user_id_patient)->lastname }}',
                            description: '{{  $appointment->id }}',
                            // start: '{{ date("Y-m-d",strtotime($appointment->dt_appointment)) }}',
                            start: '{{ date("Y-m-d\TH:i",strtotime($appointment->dt_appointment)) }}',
                            color: 'blue',
                            textColor: '#ffffff',
                            allDay: false

                        @elseif($rol_user == 4)
                            
                            title: 'Paciente: {{ App\User::find($appointment->user_id_patient)->name }} {{ App\User::find($appointment->user_id_patient)->lastname }}',
                            description: '{{  $appointment->id }}',
                            // start: '{{ date("Y-m-d",strtotime($appointment->dt_appointment)) }}',
                            start: '{{ date("Y-m-d\TH:i",strtotime($appointment->dt_appointment)) }}',
                            color: 'green',
                            textColor: '#ffffff',
                            allDay: false

                        @endif
                        
                    },
                @endforeach
            ],            
            eventClick: function(info) {               
                showModal(info.event.title, '', false, PublicURL + "appointment/showCalendar/"+ info.event._def.extendedProps.description, 'modal-xl',
                true, true, false);                 
            } 
        });
        calendar.render();
      });

  </script>
@endsection