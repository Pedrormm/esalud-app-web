@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.create_medical_appointment')</h4>
            </div>

            <div class="card-body" id="mainCardBody">
              {{-- <form action="{{ URL::asset('/appointment') }}" method="POST"> --}}
            {{-- {{ Form::open(array('url' => '/appointment/', 'method' => 'STORE','id'=> 'createAppointmentForm')) }} --}}
            {{ Form::open(array('id'=> 'createAppointmentForm')) }}

                @csrf
                @php
                if(auth()->user()->role_id == \HV_ROLES::DOCTOR) {
                    $gridCols = 6;
                }
                else
                    $gridCols = 4;
                @endphp
                    <div class="row text-center mx-auto">
                        @if(auth()->user()->role_id != \HV_ROLES::PATIENT)

                            <div class="mx-auto col-lg-{{ $gridCols }}">
                                <label>@lang('messages.patients_list') (*)</label>
                                <select required 
                                name="user_id_patient" required data-width="100%" aria-describedby="patientValidity"
                                class="selectpicker show-tick form-control"
                                data-live-search="true" title="Patient" id="patient">                        
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->lastname }}</option>
                                    @endforeach
                                </select>
                                <div id="patientValidity" class="invalid-feedback">
                                    <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> @lang('messages.please_provide_a_valid_patient')
                                </div>

                            </div>
                        @elseif (auth()->user()->role_id == \HV_ROLES::PATIENT)
                            <input type="hidden" value="{{ auth()->user()->id }}" id="patient" name="user_id_patient">
                        @endif
                        
                        @if(auth()->user()->role_id != \HV_ROLES::DOCTOR)
                            <div class="mx-auto col-lg-{{ $gridCols }}">                      
                                <label>@lang('messages.doctors_list') (*)</label>
                                <select required name="doctor_id" required data-width="100%" aria-describedby="doctorValidity"
                                class="selectpicker show-tick form-control"
                                data-live-search="true" title="Doctor" id="doctor">
                                @foreach ($doctors as $doctor)
                                    <option value={{ $doctor["id"] }} data-subtext="{{ $doctor["staff"][0]["branch"]["name"] }}">{{ $doctor["name"] . " " . $doctor["lastname"] }}</option>
                                @endforeach
                                </select> 
                                <div id="doctorValidity" class="invalid-feedback">
                                    <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> @lang('messages.please_provide_a_valid_doctor')
                                </div>

                            </div>
                        @elseif (auth()->user()->role_id == \HV_ROLES::DOCTOR)
                            <input type="hidden" value="{{ auth()->user()->id }}" id="doctor" name="doctor_id">
                        @endif
                        
                        <div class="mx-auto col-lg-{{ $gridCols }}">
                            <label>@lang('messages.appointment_date') (*)</label>
                            {{-- mirar cambio a type week --}}
                            {{-- con libreria jquery ui. https://jqueryui.com/datepicker/ --}}
                            <input required type="date" class="form-control" name="dt_appointment" id="dt_appointment"/>
                            <div id="dateValidity" class="invalid-feedback">
                                <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> @lang('messages.please_provide_a_valid_date')
                            </div>
                        </div>

                    </div>
                    
                    <div class="row mt-3" id="showAppointmentsButton">
                        <div class="col-lg-12 text-center">
                            <button type="button" class="btn btn-primary btn-lg">@lang('messages.show_appointments')</button>
                        </div>
                    </div>
          
                    <div class="row mt-3" id="createButton">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">@lang('messages.create_stat')</button>
                        </div>
                    </div>

                    {{-- <div class="card-body" id="appointmentsSchedule">
                        <div class="hv-schedule">
                          <div class='hv-header'>
                              <div></div>
                              <div>Lunes</div>
                              <div>Martes</div>
                              <div>Miércoles</div>
                              <div>Jueves</div>
                              <div>Viernes</div>
                              <div>Sábado</div>
                              <div>Domingo</div>
                          </div>
                          <div class='hv-hours'>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div data-day="1"><span class="hv-time-selection hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-time-selection hv-half hv-second-half" data-hour="0:30"></span></div>
                                  <div data-day="2"><span class="hv-time-selection hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-time-selection hv-half hv-second-half" data-hour="0:30"></span></div>
                                  <div class="hv-time-selection" data-day="3"><span class="hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="0:30"></span></div>
                                  <div class="hv-time-selection" data-day="4"><span class="hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="0:30"></span></div>
                                  <div class="hv-time-selection" data-day="5"><span class="hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="0:30"></span></div>
                                  <div class="hv-time-selection" data-day="6"><span class="hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="0:30"></span></div>
                                  <div class="hv-time-selection" data-day="7"><span class="hv-half hv-first-half" data-hour="0:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="0:30"></span></div>
                              </div>

                              <div class="hv-row">
                                <div class="hv-time-caption"><span>01:00 am</span></div>
                                <div class="hv-time-selection hv-time-selection-active" data-day="1"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                                <div class="hv-time-selection" data-day="2"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                                <div class="hv-time-selection" data-day="3"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                                <div class="hv-time-selection" data-day="4"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                                <div class="hv-time-selection" data-day="5"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                                <div class="hv-time-selection" data-day="6"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                                <div class="hv-time-selection" data-day="7"><span class="hv-half hv-first-half" data-hour="1:00"></span>
                                    <span class="hv-half hv-second-half" data-hour="1:30"></span></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>02:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                              <div class="hv-row">
                                  <div class="hv-time-caption"><span>00:00 am</span></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                                  <div class="hv-time-selection"></div>
                              </div>
                          </div>
                    </div> --}}

               

              {{ Form::close() }}
              {{-- </form> --}}
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      {{-- </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> --}}

@endsection

@section('viewsScripts')
  <script type="text/javascript" src="{{ asset('js/createAppointment.js')}}"></script>
@endsection