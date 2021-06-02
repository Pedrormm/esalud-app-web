@extends('layout.logged')

@section('nav-bar-top')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<nav class="top">
					<h3 class="div_2 on text-danger"><i class="fa fa-edit"></i> @lang('messages.medical_records')</h3>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')

	<div class="container-fluid">
	
		<div class="row mt-3 d-flex justify-content-center">
			<div class="col-lg-8 ">
				<h4 class="header_box"><i class="fa fa-user"></i> {{ $usuario->role_name }}</h4>
				
				<table class="table table-bordered" id="userInfo">
					<tbody>
						<tr>
							<td>@lang('messages.name_data'):</td>
							<td>{{ $usuario->name }}</td>
						</tr>
						<tr>
							<td>@lang('messages.surname_data'):</td>
							<td>{{ $usuario->lastname }}</td>
						</tr>
                        <tr>
							<td>Nombre de rol:</td>
							<td>{{ $usuario->role_name }}</td>
						</tr>
						<tr>
							<td>DNI:</td>
							<td>{{ $usuario->dni }}</td>
						</tr>
						<tr>
							<td>Fecha de Nacimiento:</td>
							<td><?php echo date("d/m/Y",strtotime($usuario->birthdate)); ?></td>
						</tr>
						<tr>
							<td>@lang('messages.gender_data'):</td>
							<td>
							<?php
								if($usuario->sex == "male"){
									echo \Lang::get('messages.male_data');
								}else{
									echo \Lang::get('messages.female_data');
								}
							
							?>
							</td>
						</tr>
						<tr>
							<td>Grupo Sanguíneo:</td>
							<td>{{ $usuario->blood }}</td>
						</tr>
                        @if (($usuario->role_id == \HV_ROLES::DOCTOR) || ($usuario->role_id == \HV_ROLES::HELPER)) 
                        
                        <tr>
							<td>@lang('messages.historical_number'):</td>
							<td>{{ $usuario->historic }}</td>
						</tr>
                        
                        {{-- <tr>
							<td>@lang('messages.shift_data'):</td>
							<td>
                            
                                @switch($usuario->shift)
                                    @case("M")
                                        <span>Mañana</span>
                                        @break

                                    @case("ME")
                                        <span>Mañana y Tarde</span>
                                        @break

                                    @case("MN")
                                        <span>Mañana y Noche</span>
                                        @break;

                                    @case("MEN")
                                        <span>Mañana, Tarde y Noche</span>
                                        @break;

                                    @case("E")
                                        <span>Tarde</span>
                                        @break;

                                    @case("EN")
                                        <span>Tarde y Noche</span>
                                        @break;

                                    @case("N")
                                        <span>Noche</span>
                                        @break;
                                        
                                    @default
                                        <span> </span>
                                @endswitch

                            
                            </td>
						</tr> --}}

                        <tr>
							<td>@lang('messages.office_data'):</td>
							<td>{{ $usuario->office }}</td>
						</tr>

                        <tr>
							<td>@lang('messages.room_number'):</td>
							<td>{{ $usuario->room }}</td>
						</tr>

                        <tr>
							<td>@lang('messages.business_phone_number'):</td>
							<td>{{ $usuario->h_phone }}</td>
						</tr>

                        <tr>
							<td>@lang('messages.specialty_stat'):</td>
							<td>{{ $usuario->branch_name }}</td>
						</tr>


                        @endif
					</tbody>
				</table>
				
				<div class="row mt-3">
					<div class="col-lg-4 mb-2">
						<a class="btn btn-primary bt-create-event btn-block text-white"><i class="fa fa-calendar"></i> @lang('messages.appointment_stat')</a> 
					</div>
					<div class="col-lg-4 mb-2">
						<a class="btn btn-success bt-send-message btn-block text-white"><i class="fa fa-comments"></i> @lang('messages.chat_stat')</a> 
					</div>
					<div class="col-lg-4 mb-2">
						<a class="btn btn-warning bt-open-alerts btn-block text-white"><i class="fa fa-cogs"></i> @lang('messages.alerts_stat')</a>
					</div>
				</div>
			</div>
        </div>
	</div>

@endsection

@section('viewsScripts')
	<script>
		$('#userInfo td:first-child').addClass('text-left pl-2 font-weight-bold')
	</script>
@endsection