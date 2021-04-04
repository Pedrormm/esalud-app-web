@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">

          <div class="row">
            <div class="cHeader col-2">
              <button type="button" class="btn btn-primary">
                  <i class="fas fa-arrow-left"></i>
              </button>
            </div>
            <h4 class="m-0 font-weight-bold text-primary col-8 ml-auto">Listado de tratamientos del paciente {{ $singlePatient->name . " " . $singlePatient->lastname }}</h4>
          </div>

          {{-- <h4 class="m-0 font-weight-bold text-primary text-center">Listado de tratamientos del paciente {{ $singlePatientFullName }}</h4> --}}
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="TableTreatmentsSinglePatient" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">Fecha inicio</th>
                    <th class="bg-primary">Fecha fin</th>
                    {{-- <th class="bg-primary">Paciente asociado</th> --}}
                    <th class="bg-primary">Doctor encargado</th>
                    <th class="bg-primary">Fármaco</th>
                    <th class="bg-primary">Modo de administración del fármaco</th>
                    <th class="bg-primary">Editar tratamiento</th>
                    <th class="bg-primary">Ver descripción</th>
                    <th class="bg-primary">Eliminar tratamiento</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

     
    
@endsection


@section('scriptsPropios')
  @include('treatments.treatments-single-patient', ['userId' => $singlePatient->id])
@endsection