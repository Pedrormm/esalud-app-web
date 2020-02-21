@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Historiales médicos</div>
    </nav>
@endsection

@section('content')
    <div class="tabs">
        <div class="tab" name="Historiales Médicos">
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                    <select class="sel_ord" id="record_order_type">
                        <option value="users.id">Ordenado por:</option>
                        <option value="lastname">Alfbabéticamente por apellidos</option>
                        <option value="name">Alfbabéticamente por Nombre</option>
                        <option value="historic">De menor a mayor por NªHistorial</option>
                        <option value="dni">De menor a mayor por DNI</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-2">
                    <select class="sel_sex" id="record_sex_filter">
                        <option value="no">Hombres y Mujeres</option>
                        <option value="male">Hombres</option>
                        <option value="female">Mujeres</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-2">
                    <select class="sel_old" id="record_age_filter">
                        <option value="no">Cualquier edad</option>
                        <option value="0-18">- 18 años</option>
                        <option value="18-24">18 a 24 años</option>
                        <option value="24-40">24 a 40 años</option>
                        <option value="40-65">40 a 65 años</option>
                        <option value="65-140">+ 65 años</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <input type="text" placeholder="Nombre, apellidos, historial o dni" class="inp_search" id="record_search_filter">
                </div>

                <div class="col-xs-12 col-sm-2">
                    <button type="button" id="search" class="btn btn-primary bt-search inp_height"><i class="fa fa-search"></i>Buscar</a>
                </div>
            </div>
            <div class="list_records">
                @foreach($patients as $patient) 
                    <!-- Solo obtener pacientes relacionados con usuarios -->
                        <div class="record_item col-xs-12 col-sm-6" name="{{ $patient->id }}">
                            <a name="records" href="{{ URL::asset('/user/singlerecord/'.$patient->id) }}"/>                        
                            <div class="box">
                                <div class="record_left">
                                    @if ($patient->sex=="male")
                                        <img src="{{ asset('images/avatars/user_man.PNG') }}" class="avatar big">                                                               
                                    @endif
                                    @if ($patient->sex=="female")
                                        <img src="{{ asset('images/avatars/user_woman.PNG') }}" class="avatar big">                                                               
                                    @endif
                                </div> <!-- record_left  -->
                                <div class="record_right">
                                    <div class="row">
                                        <div class=" col-xs-12 col-md-8">
                                            <div class="row">
                                                <span class="r_title col-xs-4 col-md-3">Nombre:</span>
                                                <span class="col-xs-8 col-md-9 dots">{{ urldecode($patient->name) }}</span>
                                                <span class="r_title col-xs-4 col-md-3">Apellidos:</span>
                                                <span class="col-xs-8 col-md-9 dots">{{ urldecode($patient->lastname) }}</span>
                                                <span class="r_title col-xs-4 col-md-3">Historial:</span>
                                                <span class="col-xs-8 col-md-9 dots">111444555</span>
                                                <span class="r_title col-xs-4 col-md-3">DNI:</span>
                                                <span class="col-xs-8 col-md-9">{{ $patient->dni }}</span>
                                            </div>
                                        </div>
                                        <div class="hidden-xs hidden-sm col-md-4">
                                            <div class="row">
                                                <span class="r_title hidden-xs col-sm-4">Edad:</span>
                                                <!-- <span class="col-xs-12 col-sm-8">{{ date("Y") - substr($patient->birthdate,0,4) }}</span> -->
                                                <span class="col-xs-12 col-sm-8">{{ \Carbon\Carbon::parse($patient->birthdate)->age }}</span>
                                                <span class="r_title hidden-xs col-sm-4">Sexo:</span>
                                                <span class="col-xs-12 col-sm-8">{{ $patient->sex }}</span>
                                                <span class="r_title hidden-xs col-sm-4">Altura:</span>
                                                <span class="col-xs-12 col-sm-8">{{ $patient->height }}</span>
                                                <span class="r_title hidden-xs col-sm-4">Peso:</span>
                                                <span class="col-xs-12 col-sm-8">{{ $patient->weight }}</span>
                                            </div>
                                        </div>              
                                    </div>          
                                </div>  <!-- record_right  -->    
                            </div> <!-- box  -->
                        </div> <!-- record_item  -->
                @endforeach
            </div> <!-- list_records  -->
        </div><!-- Historiales Médicos  -->

<script>
    $(document).ready(function() {  

        if (window.location.href != "{{url('user/records')}}") {
            if(sessionStorage.getItem('order') !== '') {
                $('#record_order_type').val(sessionStorage.getItem('order'));
            }
            if(sessionStorage.getItem('sex') !== '') {
                $('#record_sex_filter').val(sessionStorage.getItem('sex'));
                }
            if(sessionStorage.getItem('age') !== '') {
                $('#record_age_filter').val(sessionStorage.getItem('age'));
            }
        }
    });

    $('#search').click(function(e) {        
        let ord = $('#record_order_type').val();
        let sexFilter = $('#record_sex_filter').val();
        let ageFilter = $('#record_age_filter').val();
        let nameSearch = $('#record_search_filter').val();

        sessionStorage.setItem('order', ord);
        sessionStorage.setItem('sex', sexFilter);
        sessionStorage.setItem('age', ageFilter);

        location.href = "{{url('user/records')}}" + "/" + ord + "/" + sexFilter + "/" 
        + ageFilter + "/" + nameSearch;
    });
</script>
           
@endsection