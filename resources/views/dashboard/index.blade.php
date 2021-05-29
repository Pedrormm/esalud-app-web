@extends('layout.logged')

@section('nav-bar-top')

<!-- <nav class="top"> -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
     aria-selected="true">@lang('messages.dashboard dashboard')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="profile"
     aria-selected="false">@lang('messages.dashboard news')</a>
  </li>
</ul>
@endsection

{{-- {{ App::setLocale('es') }} --}}

@section('content')

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

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
            <div class="col-lg-4 col-sm-4 col-md-4 col-xl-4">
              <div class="card mx-auto m-3">
                <div class="card-body">
                  <h3 class="card-title">@lang('messages.dashboard daily pending and processed appointments')
                  </h3>
                  <canvas id="diaryAppointments" data-pending="@lang('messages.dashboard pending')"
                  data-processed="@lang('messages.dashboard processed')"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xl-4">
              <div class="card mx-auto m-3">
                <div class="card-body">
                  <h3 class="card-title">@lang('messages.dashboard weekly appointments title')</h3>
                  <canvas id="mostWeekAppointments" data-label="@lang('messages.dashboard weekly appointments subtitle')">
                  </canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xl-4">
              <div class="card mx-auto m-3" >
                <div class="card-body">
                  <h3 class="card-title">@lang('messages.dashboard delayed appointments')</h3>
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
                                <h3 class="card-title">@lang('messages.dashboard number of user messages title')</h3>
                                <p class="card-description">@lang('messages.dashboard number of user messages subtitle')</p>
                                <div class="table-responsive" id="msgTable">
                                    <table class="table table-striped" id="msgTable">
                                        <thead>
                                            <tr>
                                                <th> @lang('messages.dashboard messages role') </th>
                                                <th> @lang('messages.dashboard messages percentage of messages sent') </th>
                                                <th> @lang('messages.dashboard messages amount of messages sent') </th>
                                                {{-- <th> @lang('messages.dashboard messages amount of messages received') </th> --}}
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
      
      
        <div class="row ">
          <div class="col-lg-8 col-sm-4 col-md-4 col-xl-4 mx-auto">
            <div class="card mx-auto m-3 " >
              <div class="card-body">
                <h3 class="card-title">@lang('messages.dashboard user type')
                </h3>
                <canvas id="usersTypeRoles"></canvas>
              </div>
            </div>         
          </div>
        </div>

      
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




    </div>
    
    <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
      <div id="newsContainer">

      </div>

    </div>
  </div> 

@endsection

@section('viewsScripts')
  @include('dashboard.dashboard-index')
@endsection