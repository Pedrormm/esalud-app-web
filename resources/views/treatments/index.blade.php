@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">Listado de pacientes</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="mainTablePatientsTreatments" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.surname, name')</th>
                    <th class="bg-primary">Dni</th>
                    <th class="bg-primary">@lang('messages.blood group')</th>
                    <th class="bg-primary">@lang('messages.date of birth')</th>
                    <th class="bg-primary">@lang('messages.gender')</th>
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


@section('viewsScripts')
  @include('treatments.treatments-index')
@endsection