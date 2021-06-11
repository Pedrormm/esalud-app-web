      {{-- Messages List --}}
      <h6 class="dropdown-header">
        @lang('messages.alerts_center')
      </h6>

      @foreach (array_slice($data, 0, 4) as $appointment)
        <div class="dropdown-item d-flex align-items-center" data-appointment-id="{{ $appointment['id'] }}" >

          <div class="mr-3">
            <div class="bg-success appointment-summary-icon">
              <i class="fas fa-calendar-check text-white"></i>
            </div>
          </div>
          <div>
            @if (( auth()->user()->role_id) != \HV_ROLES::PATIENT)
              <span class="font-weight-bold appointment-user-size"><strong class="font-italic">@lang('messages.patient_type'): </strong>
                {{ $appointment['user_patient']["name"]." ".$appointment['user_patient']["lastname"] }}</span>
            @endif
            @if (( auth()->user()->role_id) != \HV_ROLES::DOCTOR)
              <span class="font-weight-bold appointment-user-size"><strong class="font-italic">@lang('messages.doctor_type'): </strong>
                {{ $appointment['user_doctor']["name"]." ".$appointment['user_doctor']["lastname"] }}</span>
            @endif
            <div class="appointment-summary-date" data-appointment-date="{{ $appointment['dt_appointment'] }}"></div>
          </div>
          <div class="appointment-summary-links">
            <a href="{{ url('/appointment/'.$appointment['id'].'/confirmChecked/1') }}" data-id="{{ $appointment['id'] }}" class="ml-1 primary acceptAppointmentSummary"
            data-toggle="tooltip" data-placement="top" title="@lang('messages.accept_kinda_appointment')">
              <i class="fa fa-check"></i>
            </a>
            <a href="{{ url('/appointment/'.$appointment['id'].'/confirmChecked/2') }}" data-id="{{ $appointment['id'] }}" class="ml-1 primary rejectAppointmentSummary"
            data-toggle="tooltip" data-placement="top" title="@lang('messages.reject_kinda_appointment')">
              <i class="fa fa-times"></i>
            </a>
          </div>

        </div>
      @endforeach
  
  <a class="dropdown-item text-center small text-gray-500" href="{{ URL::asset('/appointment') }}"> @lang('messages.show_all_alerts')</a>


{{-- @section('viewsScripts') --}}
  <script>

    $(".appointment-summary-date").text(function(i){
      let givenDate = $(this).attr("data-appointment-date");
      let publishedDate = getLanguageDate(givenDate);
      return publishedDate;     
    });

    $("[data-appointment-id] > div:not(.appointment-summary-links)").on('click', function(e){
      e.preventDefault();
      let id = $(this).parent("[data-appointment-id]").attr("data-appointment-id");
      // console.log(id);
      
      location.href = _publicUrl + 'appointment/'+id+'/edit';
    });

    $('.acceptAppointmentSummary').on('click', function(e){
      e.preventDefault();

      // alert("accept");

      showModal(_questionMarkSpConcat+"@lang('messages.reject_kinda_appointment')"+' '+ $(this).data('id') + '?', $(this).data('id'), false, 
      $(this).attr('href'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 
    });
    $('.rejectAppointmentSummary').on('click', function(e){
      e.preventDefault();
      // alert("reject");

      showModal(_questionMarkSpConcat+"@lang('messages.reject_kinda_appointment')"+' '+ $(this).data('id') + '?', $(this).data('id'), false, 
      $(this).attr('href'), 'modal-xl', true, true, false, null, null, "@lang('messages.no_response')", "@lang('messages.yes_response')"); 
    });
    
  </script>
{{-- @endsection --}}

