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
                    <h4 class="font-weight-bold text-primary centered">Horario disponible de 
                        {{ $userStaff->name . " ".$userStaff->lastname }}</h4>
                </div>
            </div>


            <div class="card-body" id="mainStaffScheduleBody">
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
                <div class="hv-hours"></div>
                {{-- <div class='hv-hours'>
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
                        <div class="hv-time-caption"><span>01:00 am</span></div>
                        <div class="hv-time-selection hv-time-selection-active"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
                        <div class="hv-time-selection"></div>
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
                </div> --}}
            </div>

        </div>
        <button type="button" id="SaveSchedule">Save</button>

        <!-- /.container-fluid -->

@endsection

@section('scriptsPropios')

    <script>
        staffSchedule = @json($staffSchedule);
        staffId = {{ $userStaff->id }}
        console.log(staffSchedule);
    </script>
    {{-- {{ dd($staffSchedule) }} --}}
  <script type="text/javascript" src="{{ asset('js/schedule-show.js') }}"></script>
@endsection