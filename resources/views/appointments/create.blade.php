@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Crear Cita Médica</h4>
            </div>

            <div class="card-body" id="mainCardBody">
              {{-- <form action="{{ URL::asset('/appointment') }}" method="POST"> --}}
            {{ Form::open(array('url' => '/appointment/', 'method' => 'POST','id'=> 'createAppointmentForm')) }}

                @csrf
                @php
                if(auth()->user()->role_id == \HV_ROLES::DOCTOR) {
                    $gridCols = 6;
                }
                else
                    $gridCols = 4;
                @endphp
                    <div class="row">
                        <div class="col-lg-{{ $gridCols }}">
                            <label>Listado de pacientes (*)</label>
                            <select required 
                            name="user_id_patient" required data-width="100%" aria-describedby="patientValidity"
                            class="selectpicker show-tick form-control"
                            data-live-search="true" title="Patient" id="patient">                        
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->lastname }}</option>
                                @endforeach
                            </select>
                            <div id="patientValidity" class="invalid-feedback">
                                <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> Please provide a valid patient.
                            </div>

                        </div>
                        
                        @if(auth()->user()->role_id == \HV_ROLES::ADMIN)
                            <div class="col-lg-{{ $gridCols }}">                      
                                <label>Listado de doctores (*)</label>
                                {{-- <select required class="form-control" name="user_id_doctor" id="doctor">
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->lastname }}</option>
                                    @endforeach
                                </select> --}}

                                <select required name="doctor_id" required data-width="100%" aria-describedby="doctorValidity"
                                class="selectpicker show-tick form-control"
                                data-live-search="true" title="Doctor" id="doctor">
                                @foreach ($doctors as $doctor)
                                    <option value={{ $doctor["id"] }} data-subtext="{{ $doctor["staff"][0]["branch"]["name"] }}">{{ $doctor["name"] . " " . $doctor["lastname"] }}</option>
                                @endforeach
                                </select> 
                                <div id="doctorValidity" class="invalid-feedback">
                                    <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> Please provide a valid doctor.
                                </div>

                            </div>
                        @endif
                        
                        <div class="col-lg-{{ $gridCols }}">
                            <label>Fecha de la Cita (*)</label>
                            {{-- mirar cambio a type week --}}
                            {{-- con libreria jquery ui. https://jqueryui.com/datepicker/ --}}
                            <input required type="date" class="form-control" name="dt_appointment" id="dt_appointment"/>
                            {{-- <input required type="datetime-local" class="form-control" name="dt_appointment" /> --}}
                            {{-- Min max atributo --}}
                            <div id="dateValidity" class="invalid-feedback">
                                <span aria-hidden='true' class='fas fa-exclamation-triangle'></span> Please provide a valid date.
                            </div>
                        </div>

                    </div>
                    {{-- <div class="row">
                        @if(auth()->user()->role_id == \HV_ROLES::DOCTOR)
                            <div class="col-lg-12">                      
                                <label for="txtComments">Comentarios del doctor</label>
                                <textarea id="txtComments" class="form-control" name="comments" aria-describedby="commentHelpBlock"></textarea>
                                <small id="commentHelpBlock" class="form-text text-muted">Aquí puedes poner alguna indicación especial para el paciente</small>
                            </div>
                        @endif
                    </div> --}}

                    <div class="row mt-3" id="showAppointmentsButton">
                        <div class="col-lg-12 text-center">
                            <button type="button" class="btn btn-primary btn-lg">Mostrar citas</button>
                        </div>
                    </div>
          
                    <div class="row mt-3" id="createButton">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Crear</button>
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

@section('scriptsPropios')
  <script type="text/javascript" src="{{ asset('js/createAppointment.js')}}"></script>
@endsection