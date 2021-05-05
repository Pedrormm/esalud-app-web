@extends('layout.logged')

@section('nav-bar-top')

<!-- <nav class="top"> -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Portada</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="profile" aria-selected="false">Noticias</a>
  </li>
</ul>
<!-- <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"></div>
  <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab"></div>
</div> -->


@endsection

@section('content')

    <div id="main-container" class="container-fluid">

      @if((isset($successful)) ||  (session()->has('info')))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-success">
              @if(isset($successful))
                {{ $successful }}  
              @elseif (session()->has('info'))
                {{ session()->get('info') }}
                {{ Session::forget('info') }}
              @endif   
            </div>
          </div>
        </div>
      @endif

  @if (auth()->user()->role_id == \HV_ROLES::ADMIN)

    <div class="row">
      <div class="col-lg-4">
        <div class="card mx-auto m-3 smallCanvas">
          <div class="card-body">
            <h3 class="card-title">Cantidad de citas pendientes y procesadas diarias</h5>
            <canvas id="diaryAppointments"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mx-auto m-3 smallCanvas">
          <div class="card-body">
            <h3 class="card-title">Número de citas por semana</h5>
            <canvas id="mostWeekAppointments"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mx-auto m-3 smallCanvas" >
          <div class="card-body">
            <h3 class="card-title">Cantidad de citas pendientes y procesadas retrasadas</h5>
            <canvas id="laggardAppointments"></canvas>
          </div>
        </div>        
      </div>
    </div>


    <div class="page-content page-container" id="page-content">
      <div class="padding">
          <div class="row container d-flex justify-content-center mx-auto">
              <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="card-title">Número de mensajes por usuario</h3>
                          <p class="card-description"> Número de mensajes por cada rol de usuario y número de pacientes en cada rol </p>
                          <div class="table-responsive" id="msgTable">
                              <table class="table table-striped" id="msgTable">
                                  <thead>
                                      <tr>
                                          <th> Role </th>
                                          <th> Porcentaje de mensajes enviados </th>
                                          <th> Número de mensajes enviados </th>
                                          {{-- <th> Número de mensajes recibidos </th> --}}
                                      </tr>
                                  </thead>
                                  {{-- <tbody>
                                      <tr>
                                          <td> Admin </td>
                                          <td>
                                              <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                              </div>
                                          </td>
                                          <td> 20 </td>
                                      </tr>
                                      <tr>
                                        <td> Patient </td>
                                        <td>
                                            <div class="progress">
                                              <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                        </td>
                                        <td> 25 </td>
                                    </tr>
                                    <tr>
                                      <td> Doctor </td>
                                      <td>
                                          <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                          </div>
                                      </td>
                                      <td> 2 </td>
                                  </tr>
                                  </tbody> --}}
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>



  <div class="row mb-3">
    <div class="col-lg-8 mx-auto">
      <div class="card mx-auto m-3 bigCanvas" >
        <div class="card-body">
          <h3 class="card-title">Tipos de usuario</h5>
          <canvas id="usersTypeRoles"></canvas>
        </div>
      </div>         
    </div>
  </div>



    {{-- numero de mensajes: paciente (50)
                        medico (20)
                        helper (10) --}}
                        ...

    {{-- Número de mensajes escritos por rol de usuario  --}}
    {{-- Numero de mensajes escritos, cantidad de chat --}}
    {{-- Tipos de usuario --}}

  @elseif (auth()->user()->role_id == \HV_ROLES::PATIENT)
    {{-- Cantidad de citas pendientes vs citas aprobadas y rechazadas --}}
    {{-- Cantidad de tratamientos de curso vs total de tratamientos realizados --}}
  @elseif (auth()->user()->role_id == \HV_ROLES::DOCTOR)
    {{-- Frecuencia de citas, con respecto a sí mismo --}}
    {{-- Cantidad de citas con comentario vs sin comentario --}}

    {{-- Grafica de barras con los medicamentos mas usados, en funcion de todos los medicos --}}
    {{-- Modo de administracion de los medicamentos, en funcion de todos los medicos --}}
  @endif
  
</div> {{-- main-container --}}

    <script>
 

            // $('#home-tab').click(function(e){
            //     // asyncCall('messaging/getMessages', '#main-container', true);
            //     asyncCall(PublicURL+'user/index', '#main-container', true);

            // });

            // $('#news-tab').click(function(e){
            //     asyncCall('dashboard/news', '#main-container', true);
            // });




    </script>
@endsection

@section('scriptsPropios')
  <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection