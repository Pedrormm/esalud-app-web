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
            <h4 class="font-weight-bold text-primary centered">@lang('messages.edit an appointment that has the date') {{ $appointment[0]['dt_appointment'] }}</h4>

          </div>

      </div>

      <div class="card-body" id="mainCardBody">

            {{ Form::open(array('url' => '/appointment/'.$appointment[0]['id'], 'method' => 'PUT', 'id'=>'saveEditAppointment')) }}
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.appointment details')</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <input type="hidden" value="{{ $appointment[0]['id']}}" name="appointment_id" />
                    <div class="col-lg-4">
                        <input type="text" class="form-control-plain-text" name="user_patient" placeholder=@lang('messages.patient') disabled
                        value="{{ $appointment[0]['user_patient']['name'].' '. $appointment[0]['user_patient']['lastname']}}"/>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control-plain-text" name="user_doctor" placeholder=@lang('messages.doctor') disabled
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
                        <div class="col-lg-11 mx-auto">                      
                            <label for="doctorComments">@lang('messages.doctor comments')</label>
                            <textarea id="doctorComments" class="form-control" name="doctorComments" 
                            aria-describedby="commentHelpBlockDoctor" >{{ $appointment[0]['comments']}}</textarea>
                            <small id="commentHelpBlockDoctor" class="form-text text-muted">
                                @lang('messages.special patient order')
                            </small>
                        </div>
                    @elseif ($userLogin->role_id == \HV_ROLES::DOCTOR)
                        <div class="col-lg-11 mx-auto">                      
                            <label for="patientComments">@lang('messages.patient comments')</label>
                            <textarea id="patientComments" class="form-control" name="patientComments" 
                            aria-describedby="commentHelpBlockPatient">{{ $appointment[0]['user_comment']}}</textarea>
                            <small id="commentHelpBlockPatient" class="form-text text-muted">
                                @lang('messages.special doctor order')
                            </small>
                        </div>
                    @elseif ($userLogin->role_id == \HV_ROLES::ADMIN)
                        <div class="col-lg-6">                      
                            <label for="doctorComments">@lang('messages.doctor comments')</label>
                            <textarea id="doctorComments" class="form-control" name="doctorComments" 
                            aria-describedby="commentHelpBlockDoctor" >{{ $appointment[0]['comments']}}</textarea>
                            <small id="commentHelpBlockDoctor" class="form-text text-muted">
                                @lang('messages.special patient order')
                            </small>
                        </div>
                        <div class="col-lg-6">                      
                            <label for="patientComments">@lang('messages.patient comments')</label>
                            <textarea id="patientComments" class="form-control" name="patientComments" 
                            aria-describedby="commentHelpBlockPatient">{{ $appointment[0]['user_comment']}}</textarea>
                            <small id="commentHelpBlockPatient" class="form-text text-muted">
                                @lang('messages.special doctor order')
                            </small>
                        </div>
                    @endif
                </div>

                <div class="row mb-3">
                    @if ($appointment[0]['user_creator']['role_id'] == \HV_ROLES::PATIENT)
                        <div class="col-lg-8 mx-auto">                      
                            <select name="appointmentChecked" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-header="Estado de la cita"
                            data-live-search="true" title="Estado de la cita" id="appointmentChecked">
                                <option value="0" {{ $appointment[0]['checked'] == "0" ? 'selected' : "" }}>@lang('messages.pending')</option>
                                <option value="1" {{ $appointment[0]['checked'] == "1" ? 'selected' : "" }}>@lang('messages.accepted')</option>
                                <option value="2" {{ $appointment[0]['checked'] == "2" ? 'selected' : "" }}>@lang('messages.rejected')</option>
                            </select>  
                        </div>
                    @elseif (($appointment[0]['user_creator']['role_id'] == \HV_ROLES::DOCTOR) || 
                    ($appointment[0]['user_creator']['role_id'] == \HV_ROLES::HELPER) || 
                    ($appointment[0]['user_creator']['role_id'] == \HV_ROLES::ADMIN))
                        <div class="col-lg-6">                      
                            <select name="appointmentChecked" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-header="Estado de la cita"
                            data-live-search="true" title="Estado de la cita" id="appointmentChecked">
                                <option value="0" {{ $appointment[0]['checked'] == "0" ? 'selected' : "" }}>@lang('messages.pending')</option>
                                <option value="1" {{ $appointment[0]['checked'] == "1" ? 'selected' : "" }}>@lang('messages.accepted')</option>
                                <option value="2" {{ $appointment[0]['checked'] == "2" ? 'selected' : "" }}>@lang('messages.rejected')</option>
                            </select>  
                        </div>
                        <div class="col-lg-6">                      
                            <select name="appointmentAccomplished" required class="selectpicker show-tick form-control"
                            data-width="100%" data-header="Realización de la cita"
                            data-live-search="true" title="Realización de la cita" id="appointmentAccomplished">
                                <option value="0" {{ $appointment[0]['accomplished'] == "0" ? 'selected' : "" }}>@lang('messages.not accomplished')</option>
                                <option value="1" {{ $appointment[0]['accomplished'] == "1" ? 'selected' : "" }}>@lang('messages.accomplished')</option>
                            </select>  
                        </div>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> @lang('messages.edit')</button>
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



