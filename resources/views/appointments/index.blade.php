@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Listado de citas médicas</h4>
            </div>

            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
              <table class="table table-bordered" id="mainTableAllAppointments" width="100%" cellspacing="0">
                  <thead >
                    <tr class="text-center">
                        <th class="bg-primary">Paciente</th>
                        <th class="bg-primary">Doctor</th>
                        <th class="bg-primary">Fecha</th>
                        <th class="bg-primary">Estado</th>
                        <th class="bg-primary">Acciones</th>
                    </tr>
                  </thead>
                  {{-- <tbody>
                   @foreach($appointments as $appointment)
                    <tr data-row-id="{{ $appointment['id'] }}">
                      <td>{{ $appointment['user_patient']['name'] }} {{ $appointment['user_patient']['lastname'] }}</td>
                      <td>{{ $appointment['user_doctor']['name'] }} {{ $appointment['user_doctor']['lastname'] }}</td>
                      <td>{{ date("d/m/Y H:i:s", strtotime($appointment['dt_appointment'])) }}</td>
                      <td>{{ App\Models\Appointment::getChecked($appointment['checked']) }}</td>                      
                      <td class="d-flex justify-content-center">
                        @if((auth()->user()->role_id == \HV_ROLES::PATIENT) || (auth()->user()->role_id == \HV_ROLES::DOCTOR))
                          <a class="btn btn-primary text-white btnAcceptAppointment" data-id="{{ $appointment['id'] }}"><i class="fa fa-eye"></i> Aceptar cita</a>
                          <a class="btn btn-danger text-white"><i class="fa fa-trash"></i> Rechazar cita</a>
                        @else
                          @isset($appointment['comments']))
                            <a class="btn btn-primary text-white"><i class="fa fa-eye"></i> Ver comentario</a>
                          @endisset
                
                          <a href="{{ URL::asset('/appointment/'.$appointment['id']) }}" data-id="{{ $appointment['id'] }}" class="ml-1 primary" 
                          data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                          <a href="{{ URL::asset('/appointment/'.$appointment['id']."/edit") }}" data-id="{{ $appointment['id'] }}" class="ml-1 primary" 
                          data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                          <a href="{{ URL::asset('/appointment/'.$appointment['id']."/confirmDelete") }}" data-id="{{ $appointment['id'] }}" class="ml-1 danger" 
                          data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></a>
                        @endif                      
                      </td>
                    </tr>
                   @endforeach
                   
                  </tbody> --}}
                </table>
              </div>
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
  {{-- <script src="{{ asset('js/appointments.js') }}"></script> --}}
  @include('appointments.appointments-index')
@endsection