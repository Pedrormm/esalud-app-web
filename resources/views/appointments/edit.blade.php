@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="card shadow mb-4" id="mainCardShadow">
      <div class="card-header py-3">
        <div class="row">
            <div class="cHeader col-2">
              <button type="button" class="btn btn-primary">
                  <i class="fas fa-arrow-left"></i>
              </button>
            </div>
            {{-- <h4 class="font-weight-bold text-primary mx-auto ">Editar cita con fecha {{ $appointment[0]['dt_appointment'] }}</h4> --}}
            {{-- <h4 class="font-weight-bold text-primary col-lg-6 offset-3">Editar cita con fecha {{ $appointment[0]['dt_appointment'] }}</h4> --}}
            <h4 class="font-weight-bold text-primary centered edit-appointment-header" data-appointment-id="{{ $appointment[0]['dt_appointment']}}"> @lang('messages.edit_an_appointment_that_has_the_date')  {{ $appointment[0]['dt_appointment'] }}</h4>

          </div>

      </div>

      <div class="card-body" id="mainCardBody">

            {{ Form::open(array('url' => '/appointment/'.$appointment[0]['id'], 'method' => 'PUT', 'id'=>'saveEditAppointment')) }}
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.appointment_details')</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <input type="hidden" value="{{ $appointment[0]['id']}}" name="  " />
                    <div class="col-lg-4">
                        <input type="text" class="form-control-plain-text" name="user_patient" placeholder=@lang('messages.patient_type') disabled
                        value="{{ $appointment[0]['user_patient']['name'].' '. $appointment[0]['user_patient']['lastname']}}"/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control-plain-text" name="user_doctor" placeholder=@lang('messages.doctor_type') disabled
                        value="{{ $appointment[0]['user_doctor']['name'].' '. $appointment[0]['user_doctor']['lastname']}}" />                        
                    </div>
                    <div class="col-lg-4">
                        @if ($userLogin->role_id == \HV_ROLES::PATIENT)
                            <input type="datetime-local" id="dateTimePatient" class="form-control-plain-text"
                            name="dateTimePatient" value="{{ $dtAppointment }}" disabled>
                        @elseif (($userLogin->role_id == \HV_ROLES::DOCTOR) || ($userLogin->role_id == \HV_ROLES::HELPER) || ($userLogin->role_id == \HV_ROLES::ADMIN))
                            <input type="datetime-local" id="dateTimeOther" class="form-control-plain-text"
                            name="dateTimeOther" value="{{ $dtAppointment }}" >
                        @endif
                        
                    </div>
                </div>

                <div class="row mb-3">
                    @if ($userLogin->role_id == \HV_ROLES::PATIENT)
                        <div class="col-lg-6">                      
                            <label for="doctorComments">@lang('messages.doctor_comments')</label>
                            <textarea disabled id="doctorComments" class="form-control" name="doctorComments" 
                            aria-describedby="commentHelpBlockDoctor" >{{ $appointment[0]['comments']}}</textarea>
                        </div>
                        <div class="col-lg-6">                      
                            <label for="patientComments">@lang('messages.patient_comments')</label>
                            <textarea id="patientComments" class="form-control" name="patientComments" 
                            aria-describedby="commentHelpBlockPatient">{{ $appointment[0]['user_comment']}}</textarea>
                            <small id="commentHelpBlockPatient" class="form-text text-muted">
                                @lang('messages.special_doctor_order')
                            </small>    
                        </div>
                    @elseif ($userLogin->role_id == \HV_ROLES::DOCTOR)
                        <div class="col-lg-6">                      
                            <label for="doctorComments">@lang('messages.doctor_comments')</label>
                            <textarea id="doctorComments" class="form-control" name="doctorComments" 
                            aria-describedby="commentHelpBlockDoctor" >{{ $appointment[0]['comments']}}</textarea>
                            <small id="commentHelpBlockDoctor" class="form-text text-muted">
                                @lang('messages.special_patient_order')
                            </small>
                        </div>
                        <div class="col-lg-6">                      
                            <label for="patientComments">@lang('messages.patient_comments')</label>
                            <textarea disabled id="patientComments" class="form-control" name="patientComments" 
                            aria-describedby="commentHelpBlockPatient">{{ $appointment[0]['user_comment']}}</textarea>   
                        </div>
                    @elseif ($userLogin->role_id == \HV_ROLES::HELPER)
                        <div class="col-lg-6">                      
                            <label for="doctorComments">@lang('messages.doctor_comments')</label>
                            <textarea disabled id="doctorComments" class="form-control" name="doctorComments" 
                            aria-describedby="commentHelpBlockDoctor" >{{ $appointment[0]['comments']}}</textarea>
                        </div>
                        <div class="col-lg-6">                      
                            <label for="patientComments">@lang('messages.patient_comments')</label>
                            <textarea disabled id="patientComments" class="form-control" name="patientComments" 
                            aria-describedby="commentHelpBlockPatient">{{ $appointment[0]['user_comment']}}</textarea>
                        </div>
                    @elseif ($userLogin->role_id == \HV_ROLES::ADMIN)
                        <div class="col-lg-6">                      
                            <label for="doctorComments">@lang('messages.doctor_comments')</label>
                            <textarea id="doctorComments" class="form-control" name="doctorComments" 
                            aria-describedby="commentHelpBlockDoctor" >{{ $appointment[0]['comments']}}</textarea>
                            <small id="commentHelpBlockDoctor" class="form-text text-muted">
                                @lang('messages.special_patient_order')
                            </small>
                        </div>
                        <div class="col-lg-6">                      
                            <label for="patientComments">@lang('messages.patient_comments')</label>
                            <textarea id="patientComments" class="form-control" name="patientComments" 
                            aria-describedby="commentHelpBlockPatient">{{ $appointment[0]['user_comment']}}</textarea>
                            <small id="commentHelpBlockPatient" class="form-text text-muted">
                                @lang('messages.special_doctor_order')
                            </small>    
                        </div>
                    @endif
                </div>

                <div class="row mb-3">
                    @if ($userLogin->role_id == \HV_ROLES::PATIENT)
                        <div class="col-lg-8 mx-auto">                      
                            <select name="appointmentChecked" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-header=@lang('messages.appointment_status')
                            data-live-search="true" title=@lang('messages.appointment_status') id="appointmentChecked">
                                <option value="0" {{ $appointment[0]['checked'] == "0" ? 'selected' : "" }}>@lang('messages.pending_stat')</option>
                                <option value="1" {{ $appointment[0]['checked'] == "1" ? 'selected' : "" }}>@lang('messages.accepted_stat')</option>
                                <option value="2" {{ $appointment[0]['checked'] == "2" ? 'selected' : "" }}>@lang('messages.rejected_stat')</option>
                            </select>  
                        </div>
                        <input type="hidden" value="{{ $appointment[0]['accomplished'] }}" name="appointmentAccomplished">
                    @else
                        <div class="col-lg-6">                      
                            <select name="appointmentChecked" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-header=@lang('messages.appointment_status')
                            data-live-search="true" title=@lang('messages.appointment_status') id="appointmentChecked">
                                <option value="0" {{ $appointment[0]['checked'] == "0" ? 'selected' : "" }}>@lang('messages.pending_stat')</option>
                                <option value="1" {{ $appointment[0]['checked'] == "1" ? 'selected' : "" }}>@lang('messages.accepted_stat')</option>
                                <option value="2" {{ $appointment[0]['checked'] == "2" ? 'selected' : "" }}>@lang('messages.rejected_stat')</option>
                            </select>  
                        </div>
                        <div class="col-lg-6">                      
                            <select name="appointmentAccomplished" required class="selectpicker show-tick form-control"
                            data-width="100%" data-header=@lang('messages.appointment_fulfillment')
                            data-live-search="true" title=@lang('messages.appointment_fulfillment') id="appointmentAccomplished">
                                <option value="0" {{ $appointment[0]['accomplished'] == "0" ? 'selected' : "" }}>@lang('messages.not_accomplished')</option>
                                <option value="1" {{ $appointment[0]['accomplished'] == "1" ? 'selected' : "" }}>@lang('messages.accomplished_stat')</option>
                            </select>  
                        </div>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> @lang('messages.edit_stat')</button>
                    </div>
                </div>
            
            {{ Form::close() }}
            {{-- </form> --}}
            
        </div>
    </div>

  </div>

  @endsection

    @section('viewsScripts')
        <script>

            $(".edit-appointment-header").text(function(i){
                let givenDate = $(this).attr("data-appointment-id");
                let publishedDate = getLanguageDate(givenDate);
                return _messagesLocalization.edit_an_appointment_that_has_the_date + " " + publishedDate;     
            });

            $('.cHeader button').on('click', function(e){
                e.preventDefault();
                window.location.href = _publicUrl+"appointment/";
            });


            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
            let yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd
            } 
            if(mm<10){
                mm='0'+mm
            } 

            today = yyyy+'-'+mm+'-'+dd;
            if ($('#dateTimePatient').length) 
                $('#dateTimePatient').attr("min",today);
            else if ($('#dateTimeOther').length){
                $('#dateTimeOther').attr("min",today);
            }
        </script>
    @endsection



