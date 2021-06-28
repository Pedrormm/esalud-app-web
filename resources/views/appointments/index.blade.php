@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.medical_appointments_list')</h4>
            </div>

            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
              <table class="table table-bordered changableTable" id="mainTableAllAppointments" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                        @if (( auth()->user()->role_id) != \HV_ROLES::PATIENT)
                          <th class="bg-primary">@lang('messages.patient_type')</th>
                        @endif
                        @if (( auth()->user()->role_id) != \HV_ROLES::DOCTOR)
                          <th class="bg-primary">@lang('messages.doctor_type')</th>
                        @endif
                        <th class="bg-primary">@lang('messages.date_data')</th>
                        @if (($appointmentType) == "all")
                          <th class="bg-primary">@lang('messages.state_stat')</th>
                        @endif
                        <th class="bg-primary">@lang('messages.actions_stat')</th>
                    </tr>
                  </thead>

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

@section('viewsScripts')
  {{-- <script src="{{ asset('js/appointments.js') }}"></script> --}}
  @include('appointments.appointments-index', ['appointmentType'=>$appointmentType])

@endsection