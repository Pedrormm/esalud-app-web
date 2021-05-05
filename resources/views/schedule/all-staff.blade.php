@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">Listado de empleados</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="scheduleStaffTable" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">Apellidos, Nombre</th>
                    <th class="bg-primary">Dni</th>
                    <th class="bg-primary">Rol</th>
                    <th class="bg-primary">Especialidad</th>
                    <th class="bg-primary">Fecha de nacimiento</th>
                    <th class="bg-primary">Sexo</th>
                    <th class="bg-primary">Ver horario</th>
                    <th class="bg-primary">Eliminar horarios</th>
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
  @include('schedule.schedule-all-staff')
@endsection