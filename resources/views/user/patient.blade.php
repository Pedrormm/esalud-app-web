@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Pacientes</div>
    </nav>
@endsection

@section('content')

<div class="tabs">
    <div class="tab" name="Pacientes">
        <div class="box">
            <h5 class="header_box"><i class="fa fa-group"></i>Listado de pacientes</h5>
            <div class="row">
                <div class="col-xs-12 col-sm-10">
                    <input type="text" placeholder="Buscar por nombre, apellidos, historial o dni" name="searcher_patients" id="patient_search_filter">
                </div>
                <div class="col-xs-12 col-sm-2">
                    <a class="btn btn-primary bt-search inp_height" id="patsearch"><i class="fa fa-search"></i>Buscar</a>
                </div>
            </div>
            <div class="row patients_list_header">
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3"><h5>Apellidos, Nombre</h5></div>
                <div class="hidden-xs col-sm-4 col-md-2 col-lg-2"><h5>Nº Historial</h5></div>
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2"><h5>Dni</h5></div>
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2"><h5>Grupo sanguíneo</h5></div>
                <div class="hidden-xs hidden-sm hidden-md col-lg-2"><h5>Fecha de nacimiento</h5></div>
                <div class="hidden-xs hidden-sm hidden-md col-lg-1"><h5>Sexo</h5></div>
            </div>
            <ul class="patients_list list_limit_height-lg">
                
            @foreach($patients as $patient) 
            <li class="patient_item" name="{{ $patient->id }}">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3"> 
                        @if ($patient->sex=="male")
                            <img class="avatar" src="{{ asset('images/avatars/user_man.PNG') }}" class="avatar big">                                                               
                        @endif
                        @if ($patient->sex=="female")
                            <img class="avatar" src="{{ asset('images/avatars/user_woman.PNG') }}" class="avatar big">                                                               
                        @endif
                        <span>{{ urldecode($patient->lastname).", ".urldecode($patient->name) }}</span>
                    </div>          
                    <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">
                        <span>{{ $patient->historic }}</span>          
                    </div>          
                    <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              
                        <span>{{ $patient->dni }}</span>          
                    </div>          
                    <div class="hidden-xs hidden-sm col-md-2 col-lg-2">
                        <span>{{ $patient->blood }}</span>                    
                    </div>          
                    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
                        <span>{{ $patient->birthdate }}</span>                    
                    </div>          
                    <div class="hidden-xs hidden-sm hidden-md col-lg-1">              
                        <span>{{ $patient->sex }}</span>                
                    </div>      
                </div>  
            </li>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {  
        if (window.location.href != "{{url('user/patient')}}") {
            if(sessionStorage.getItem('search') !== '') {
                $('#patient_search_filter').val(sessionStorage.getItem('search'));
            }
        }
    });

    $('#patsearch').click(function(e) {        
        let nameSearch = $('#patient_search_filter').val();

        sessionStorage.setItem('search', nameSearch);

        location.href = "{{url('user/patient')}}" + "/" + nameSearch;
    });
</script>
    
@endsection