{{-- @extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Staff</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('staff.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('staff.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection --}}

@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">Listado de personal</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="mainTableStaff" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">Apellidos, Nombre</th>
                    <th class="bg-primary">Rol</th>
                    <th class="bg-primary">Nº Historial</th>
                    <th class="bg-primary">Especialidad</th>
                    <th class="bg-primary">Turno</th>
                    <th class="bg-primary">Oficina</th>
                    <th class="bg-primary">Habitación</th>
                    <th class="bg-primary">Teléfono de ofcina</th>
                    <th class="bg-primary">Dni</th>
                    <th class="bg-primary">Grupo sanguíneo</th>
                    <th class="bg-primary">Fecha de nacimiento</th>
                    <th class="bg-primary">Teléfono</th>
                    <th class="bg-primary">Sexo</th>
                    <th class="bg-primary">Acciones</th>
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
  @include('staff.staff-index')
@endsection