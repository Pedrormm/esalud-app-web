@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Personal</div>
    </nav>
@endsection

@section('content')


<div class="tabs hv-staff">
    <div class="tab" name="Personal">
        <div class="box">
            <h5 class="header_box">
                <i class="fa fa-user-md"></i>Listado del personal
            </h5>
            <div class="row filter_staff">
                <div class="col-xs-12 col-sm-4">
                    <div class="row">
                        <div class="col-xs-6">
                            <select class="sel-branch">
                                <option value="0">Cualquier Rama</option>
                                <option value="-1">Administrativo</option>
                                <option value="1">Alergologia</option>
                                <option value="2">Anestesiologia</option>                                        
                                <option value="3">Angiologia</option>                                        
                                <option value="4">Bariatria</option>                                        
                                <option value="5">Cardiologia</option>                                        
                                <option value="6">Cirugia General</option>                                        
                                <option value="7">Cirugia Maxilofacial</option>                                        
                                <option value="8">Cirugia Plastica</option>                                        
                                <option value="9">Cirugia Estetica</option>                                        
                                <option value="-1">Citaciones (Administrativo)</option>                                        
                                <option value="10">Dermatologia</option>                                        
                                <option value="11">Enocrinologia</option>                                        
                                <option value="12">Endoscopia</option>                                        
                                <option value="13">Fisiatria</option>                                        
                                <option value="14">Gastroenterologia</option>                                        
                                <option value="15">Geriatria</option>                                        
                                <option value="16">Ginecologia</option>                                        
                                <option value="17">Hematologia</option>                                        
                                <option value="18">Homeopatía</option>                                        
                                <option value="19">Infectologia</option>                                        
                                <option value="20">Inmunologia</option>                                        
                                <option value="21">Medicina general</option>                                        
                                <option value="22">Microcirugia</option>                                        
                                <option value="23">Nefrologia</option>                                        
                                <option value="24">Neonatologia</option>                                        
                                <option value="25">Neumologia</option>                                        
                                <option value="26">Neurologia</option>                                        
                                <option value="27">Neurocirugia</option>                                        
                                <option value="28">Nutricion</option>                                        
                                <option value="29">Oftalmologia</option>                                        
                                <option value="30">Oncologia</option>                                        
                                <option value="31">Ortopedia</option>                                        
                                <option value="32">Otorrinolaringologia</option>                                        
                                <option value="33">Pediatria</option>                                        
                                <option value="34">Patologia</option>                                        
                                <option value="35">Perinatologia</option>                                        
                                <option value="36">Proctologia</option>                                        
                                <option value="37">Psiquiatria</option>                                        
                                <option value="38">Radiologia</option>                                        
                                <option value="-2">Recepcionista (Administrativo)</option>                                        
                                <option value="39">Reumatologia</option>                                        
                                <option value="-3">Secretario/a (Administrativo)</option>                                        
                                <option value="40">Traumatologia</option>                                        
                                <option value="41">Urologia</option>                                        
                                <option value="42">Otros (P.Sanitario)</option>
                                <option value="-4">Otros (P.Administrativo)</option>                                
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <select class="sel-horary">
                                <option value="0">Cualquier horario</option>
                                <option value="M">Mañana</option>
                                <option value="E">Tarde</option>
                                <option value="N">Noche</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" class="inp-name" placeholder="Nombre o identificador">
                </div>
                <div class="col-xs-12 col-sm-2">
                    <a class="btn btn-primary bt-search inp_height"><i class="fa fa-search"></i>Buscar</a>
                </div>
            </div>
            <div class="row staff_list_header">
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3"><h5>Apellidos, Nombre</h5></div>
                <div class="hidden-xs col-sm-4 col-md-2 col-lg-2"><h5>Rama</h5></div>
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2"><h5>Consulta</h5></div>
                <div class="hidden-xs hidden-sm col-md-2 col-lg-2"><h5>Telefono</h5></div>
                <div class="hidden-xs hidden-sm hidden-md col-lg-2"><h5>Oficina</h5></div>
                <div class="hidden-xs hidden-sm hidden-md col-lg-1"><h5>Horario</h5></div>
            </div>
            <ul class="staff_list list_limit_height-lg">
                <li class="staff_item" name="2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-3">              
                            <img class="avatar" src="http://localhost/denis/resources/images/avatars/doctor.png">              
                                Chacon Perez, Juan          
                        </div>          
                        <div class="hidden-xs col-sm-4 col-md-2 col-lg-2">              
                            Fisiatria          
                        </div>          
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              
                            666          
                        </div>          
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-2">              
                            112          
                        </div>          
                        <div class="hidden-xs hidden-sm hidden-md col-lg-2">              
                            41          
                        </div>          
                        <div class="hidden-xs hidden-sm hidden-md col-lg-1">               
                            Tarde  Noche          
                        </div>      
                    </div>  
                </li>
            </ul>
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