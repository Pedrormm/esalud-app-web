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
				<h4 class="header_box"><i class="fa fa-user"></i> @lang('messages.patient_type')</h4>
				
				<table class="table table-bordered ">
					<tbody>
						<tr>
							<td>@lang('messages.name_data'):</td>
							<td>{{ $usuario['name'] }}</td>
						</tr>
						<tr>
							<td>@lang('messages.surname_data'):</td>
							<td>{{ $usuario->lastname }}</td>
						</tr>
						<tr>
							<td>Nº@lang('messages.historical_stat'):</td>
							<td>{{ $patient->historic }}</td>
						</tr>
						<tr>
							<td>DNI:</td>
							<td>{{ $usuario->dni }}</td>
						</tr>
						<tr>
							<td>@lang('messages.date_of_birth'):</td>
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
							<td>@lang('messages.height_data'):</td>
							<td>{{ $patient->height }} cm</td>
						</tr>
						<tr>
							<td>@lang('messages.weight_data'):</td>
							<td>{{ $patient->weight }} kg</td>
						</tr>
						<tr>
							<td>@lang('messages.blood_group'):</td>
							<td>{{ $usuario->blood }}</td>
						</tr>
						
					</tbody>
				</table>
				
				<div class="row mt-3">
					<div class="col-lg-4 mb-2 mx-auto">
						<a class="btn btn-primary bt-create-event btn-block text-white" href="{{ url('appointment') }}"><i class="fa fa-calendar"></i> @lang('messages.appointment_stat')</a> 
					</div>
					<div class="col-lg-4 mb-2 mx-auto">
						<a class="btn btn-success bt-send-message btn-block text-white" data-chat-record-id="{{ $usuario->id }}" href="{{ url('/messaging') }}"><i class="fa fa-comments"></i> @lang('messages.chat_stat')</a> 
					</div>
					{{-- <div class="col-lg-4 mb-2">
						<a class="btn btn-warning bt-open-alerts btn-block text-white"><i class="fa fa-cogs"></i> @lang('messages.alerts_stat')</a>
					</div> --}}
				</div>
			</div>
        </div>

        @if ($userTreatments)
            <div class="row mt-3">
                <div class="col-lg-7 mx-auto text-center">
                    
                    <div class="box box-danger">					
                        <div class="box-header with-border">
                        <h3 class="box-title">@lang('messages.treatments_stat')</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool tratamientos" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>                    
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="bg-primary">@lang('messages.start_date')</th>
                                                    <th class="bg-primary">@lang('messages.end_date')</th>
                                                    <th class="bg-primary">@lang('messages.doctor_in_charge')</th>
                                                    <th class="bg-primary">@lang('messages.medicine_drug')</th>
                                                    <th class="bg-primary">@lang('messages.medicine_administration')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($userTreatments as $treatment)
                                                <tr>
                                                    <td>{{ $treatment["startingDate"] ?? "[".\Lang::get('messages.there_is_no_starting_date')."]" }}</td>
                                                    <td>{{ $treatment["endingDate"] ?? "[".\Lang::get('messages.there_is_no_ending_date')."]" }}</td>
                                                    <td>{{ $treatment["user_doctor"]?$treatment["user_doctor"]["name"] . " " . $treatment["user_doctor"]["lastname"]:null }}</td>
                                                    <td>{{ $treatment["type_medicine"]["name"]  }}</td>
                                                    <td>{{ $treatment["medicine_administration"] ?? "[".\Lang::get('messages.generic_treatment')."]" }}</td>
                                                    
                                                </tr>                                                        
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 					
                    </div>

                </div>
            </div>
        @endif

        @if ($appointments)
            <div class="row mt-3">
                <div class="col-lg-7 mx-auto text-center">
                    
                    <div class="box box-danger">					
                        <div class="box-header with-border">
                        <h3 class="box-title">@lang('messages.nav-main_appointments')</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool tratamientos" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>                    
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    @if (( $usuario->role_id) != \HV_ROLES::PATIENT)
                                                        <th class="bg-primary">@lang('messages.patient_type')</th>
                                                    @endif
                                                    @if (( $usuario->role_id) != \HV_ROLES::DOCTOR)
                                                        <th class="bg-primary">@lang('messages.doctor_type')</th>
                                                        <th class="bg-primary">@lang('messages.specialty_stat')</th>                                    
                                                    @endif
                                                    <th class="bg-primary">@lang('messages.date_data')</th>
                                                    <th class="bg-primary">@lang('messages.state_stat')</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($appointments as $appointment)
                                                <tr>
                                                    @if (( $usuario->role_id) != \HV_ROLES::PATIENT)
                                                        <td>{{ $appointment["user_patient"]["name"] . " " . $appointment["user_patient"]["lastname"] }}</td>                                                    @endif
                                                    @if (( $usuario->role_id) != \HV_ROLES::DOCTOR)

                                                        <td>{{ $appointment["user_doctor"]?$appointment["user_doctor"]["name"] . " " . $appointment["user_doctor"]["lastname"]:null }}</td> 
                                                        <td>{{ $appointment["user_doctor"]?$appointment["user_doctor"]["staff"][0]["branch"]["name"]:null}}</td> 
                                                    @endif
                                                    <td class="record-appointment-date" data-record-appointment-date="{{ $appointment["dt_appointment"] }}"></td>
                                                    <td>{{ $appointment["checkedStatus"]  }}</td>
                                                    
                                                </tr>                                                        
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 					
                    </div>

                </div>
            </div>
        @endif

	</div>

@endsection

@section('viewsScripts')
    <script>

        $("[data-chat-record-id]").on('click', function(e){
            e.preventDefault();
            let id = $(this).attr("data-chat-record-id");
            // console.log(id);
            window.localStorage.setItem("contact-id",id);
            location.href = $(this).attr("href");
        });

        $("[data-record-appointment-date]").text(function(i){
            let givenDate = $(this).attr("data-record-appointment-date");
            let publishedDate = getLanguageDate(givenDate);
            return publishedDate;     
        });

        $('.eventClose').click(function(){
        $(this).parent().parent().parent().fadeOut();
        })

        $('.tratamientos').click(function(){
        $(this).parent().parent().parent().fadeOut();
        })
        
        $('.sesiones').click(function(){
        $(this).parent().parent().parent().fadeOut();
        })
    </script>
@endsection