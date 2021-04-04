@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">Listado de pacientes</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="mainTablePatientsTreatments" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">Apellidos, Nombre</th>
                    <th class="bg-primary">Dni</th>
                    <th class="bg-primary">Grupo sanguíneo</th>
                    <th class="bg-primary">Fecha de nacimiento</th>
                    <th class="bg-primary">Sexo</th>
                    <th class="bg-primary">Crear tratamiento</th>
                    <th class="bg-primary">Ver tratamientos</th>
                    <th class="bg-primary">Eliminar todos los tratamientos</th>
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
  @include('treatments.treatments-index')
@endsection