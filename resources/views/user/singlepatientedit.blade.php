@extends('layout.logged')

@section('nav-bar-top')
    <nav class="top">
        <div class="div_2 on">Pacientes</div>
    </nav>
@endsection

@section('content')

<div class="popup" name="32" style="top: 50px;">
	<div class="popupHeader blue">
		<span>Paciente</span>
		<nav class="closePopup">
			<i class="fa fa-times"></i>
		</nav>
	</div>
<div class="popupWrapper">
	<div class="hv-patient_details">
		<span class="section-header"><i class="fa fa-hospital-o"></i>Datos Clínicos: </span>
		<div class="basic_info row">
			<div class="col-xs-12 col-sm-6">
				Nombre y Apellidos:
				<input type="text" value="Maria Marques Munoz" disabled="" class="readable">
			</div>
			<div class="col-xs-12 col-sm-6">
				Número de historial:
				<input type="text" name="p_historic" value="987654321" disabled="" class="readable">
			</div>
			<div class="col-xs-12 col-sm-6">
				Altura:
				<input type="text" name="p_height" value="180">
			</div>
			<div class="col-xs-12 col-sm-6">
				Peso:
				<input type="text" name="p_weight" value="96">
			</div>
			<div class="col-xs-12">
				<div class="col-xs-12 col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8 col-lg-3 col-lg-offset-9">
					<span class="btn btn-primary bt-save">Guardar</span>
				</div>
			</div>    
		</div>
		<span class="section-header"><i class="fa fa-user-md"></i>Personal sanitario asignado</span>
		<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-3">
			<select class="filter_branch">
				<option value="0">Cualquier Rama</option>
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
            <div class="col-xs-12 col-sm-8 col-md-9">
                <input class="inp-search" type="text" placeholder="Añade personal (nombre o identificador)">
            </div>
        </div>    
		<div class="doctors_list">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4"><h5>Apellidos, Nombre</h5></div>
				<div class="hidden-xs col-sm-3 col-md-3"><h5>Identificador</h5></div>
				<div class="hidden-xs col-sm-3 col-md-3"><h5>Horario</h5></div>
				<div class="hidden-xs hidden-sm col-md-2"><h5>Rama</h5></div>
			</div>
			<ul>
				<li class="doctor_item" name="11">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<img class="avatar" src="http://localhost/denis/resources/images/avatars/doctor.png">
							Manuel Lopez Marin                            
						</div>
						<div class="hidden-xs col-sm-3 col-md-3">
							2147483647                            
						</div>
						<div class="hidden-xs col-sm-3 col-md-3">
							Mañana  Noche                            
						</div>
						<div class="hidden-xs hidden-sm col-md-2">
							Neumologia                            
						</div>
					</div>
                    <i class="fa fa-trash-o bt-delete-doctor"></i>
                </li>
			</ul>
		</div>
	</div>
</div>


<style>
    .hv-patient_details .doctors_list{
        padding: 5px 10px;
        max-height: 250px;
        overflow-y: auto;
    }
    .hv-patient_details .doctors_list li {
        display: block;
        position: relative;
        font-size: 14px;
    }
    .hv-patient_details .doctors_list li:hover{
        background-color: #f7f7f7;
    }
    .hv-patient_details .doctors_list li i.bt-delete-doctor{
        position: absolute;
        right: 5px;
        top: 10px;
    }
    .hv-patient_details .doctor_item{
        line-height: 30px;
    }
</style>
    
@endsection