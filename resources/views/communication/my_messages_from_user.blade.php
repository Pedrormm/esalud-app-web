@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- My messages tittle -->
          <div class="">
            <div class="msj-title">
                <h4 class="bold text-center">
                    {{ $userFrom->name." ".$userFrom->lastname}}
                </h4>
            </div> <!-- msj-title -->

            @foreach($userMessages as $i=>$userMessage)
                
                <div class="center_elements">  
                    <div class="col-lg-10 ">
                        <div class="card shadow mb-4" id="mainCardShadow">

                            <div class="msj-whole-card {{ ($userMessage['read']==0 )? " new-message":'' }}">
                                <!-- Card Header -->
                                <div class="msj-card">
                                    <div class="msj-image">
                                        <figure class="">
                                            @if (!empty($userMessage['avatar']))
                                                <img class="avatar big" src="{{ asset('images/avatars/'.$userMessage['avatar']) }}">                                                               
                                            @else
                                                @if ($userMessage['sex']=="male")
                                                    <img class="avatar big" src="{{ asset('images/avatars/user_man.png') }}">                                                               
                                                @endif
                                                @if ($userMessage['sex']=="female")
                                                    <img class="avatar big" src="{{ asset('images/avatars/user_woman.png') }}">                                                               
                                                @endif
                                            @endif                            
                                        </figure>                
                                    </div> <!-- msj-image -->
                                    
                                    <div class="msj-content">
                                        <div class="card-header py-3 d-flex flex-row align-items-center 
                                        justify-content-between">
                                                <h3 class="m-0 font-weight-bold text-primary bold">
                                                    {{ $userMessage['name']. " " .$userMessage['lastname'] }}
                                                </h3>

                                        </div> <!-- card-header -->
                                        <!-- Card Body -->
                                        <div class="card-body" id="mainCardBody">
                                            {{ $userMessage['messageCorrected'] }}
                                        </div> <!-- card-body -->
                                    </div> <!-- msj-content -->
                                </div> <!-- msj-card -->

                                <div class="msj-date-and-bar">
                                    <div class="dropdown no-arrow">
                                        <div class="msj-derecho">
                                            <div class="msj-fecha">
                                                <span class="cnvrsDate" data-utcdate="2020-3-5T14:22:00.000Z">1 día, 10 horas</span>
                                            </div> <!-- msj-fecha -->
                                            <div class="msj-opciones">
                                                <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" 
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                    <div class="dropdown-header">
                                                        @lang('messages.actions_stat'):
                                                    </div>
                                                    @if ($userMessage['read']==0)
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            @lang('messages.mark_as_read')
                                                        </a>
                                                    @endif
                                                    <a class="dropdown-item" href="javascript:void(0);">
                                                        @lang('messages.delete_this_message')
                                                    </a>
                                                </div>  <!-- animated--fade-in -->                                  
                                            </div> <!-- msj-opciones -->
                                        </div> <!-- msj-derecho -->
                                    </div> <!-- dropdown no-arrow -->
                                </div> <!-- msj-date-and-bar -->
                            </div> <!-- msj-whole-card -->

                        </div> <!-- card shadow mb-4 -->
                    </div> <!-- col-lg-10 -->
                </div> <!-- center_elements -->

            @endforeach <!-- userMessages -->
          </div> <!-- My messages tittle -->


        </div> <!-- container-fluid -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

    
@endsection