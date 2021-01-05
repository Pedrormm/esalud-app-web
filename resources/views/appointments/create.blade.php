@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Crear Cita Médica</h4>
            </div>
            <!-- <div class="row center_elements">
                <div class="col-xs-11 col-md-10">
                    <input type="text" placeholder="Buscar por nombre, apellidos, historial o dni" name="searcher_patients" id="patient_search_filter">
                </div>
                <a class="col-xs-11 col-md-1 btn btn-primary bt-search inp_height color_white" id="patsearch">
                    <i class="fa fa-search"></i>Buscar
                </a>
            </div> -->
            <div class="card-body">
              <form action="{{ URL::asset('/appointment') }}" method="POST">
                @csrf
                @php
                if(auth()->user()->role_id == \HV_ROLES::PERM_DOCTOR) {
                    $gridCols = 6;
                }
                else
                    $gridCols = 4;
                @endphp
                    <div class="row">
                        <div class="col-lg-{{ $gridCols }}">
                            <label>Listado de pacientes (*)</label>
                            <select required class="form-control" name="user_id_patient">
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        @if(auth()->user()->role_id == \HV_ROLES::PERM_ADMIN)
                            <div class="col-lg-{{ $gridCols }}">                      
                                <label>Listado de doctores (*)</label>
                                <select required class="form-control" name="user_id_doctor">
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="col-lg-{{ $gridCols }}">
                            <label>Fecha de la Cita (*)</label>
                            <input required type="datetime-local" class="form-control" name="dt_appointment" />
                            {{-- Min max atributo --}}
                        </div>

                    </div>
                    <div class="row">
                        @if(auth()->user()->role_id == \HV_ROLES::PERM_DOCTOR)
                            <div class="col-lg-12">                      
                                <label for="txtComments">Comentarios del doctor</label>
                                <textarea id="txtComments" class="form-control" name="comments" aria-describedby="commentHelpBlock"></textarea>
                                <small id="commentHelpBlock" class="form-text text-muted">Aquí puedes poner alguna indicación especial para el paciente</small>
                            </div>
                        @endif
                    </div>
          
                    <div class="row mt-3">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Crear</button>
                        </div>
                    </div>
              </form>
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