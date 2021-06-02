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
        <div class="row mt-3 d-flex justify-content-center">
			<div class="col-lg-6">
				<h4 class="header_box"><i class="fa fa-report"></i> @lang('messages.list_of_patient_evolutionary_reports')</h4>
				
				<div class="row">
				  @foreach($events as $event)
					<div class="col-lg-6">
						<div class="box box-success">					
							<div class="box-header with-border boxEvent">
							  <h3 class="box-title">{{$event->request}} (<?php echo date("d/m/Y",strtotime($event->created_at)); ?>) </h3>
							  <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool eventClose" data-bs-dismiss="alert" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
							  </div>
							</div>
							
							<div class="box-body">
								<div class="row">
									<div class="col-lg-12">
										<label><b>@lang('messages.doctor_type'):</b> {{ $event->doctorFullName }}</label> 
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<label><b>@lang('messages.report_stat'):</b></label>
										<p>{{urldecode($event->report)}}</p>
									</div>
								</div>
							</div> 					
						</div>
					</div>
				  @endforeach
				</div>				
			
			</div>
		</div>
       
        {{-- <div class="row mt-3">
            <div class="col-lg-12">
                <div class="box box-success">					
                    <div class="box-header with-border">
                      <h3 class="box-title">Analíticas</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>                    
                    <div class="box-body">
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="box box-danger">					
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Subpoblaciones Linfocitaria</h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Linf</th>
                                                                <th>T4</th>
                                                                <th>T4 Abs</th>
                                                                <th>%T8</th>
                                                                <th>T8 Abs</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($analytics1 as $analytic2)
                                                            <tr>
                                                                <td><?php echo date("d/m/Y", strtotime($analytic2->created_at)); ?></td>
                                                                <?php $resultados = json_decode($analytic2->result); ?>
                                                                @foreach($resultados as $resultado)
                                                                    <td>{{ $resultado }}</td>
                                                                @endforeach
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
                            
                            <div class="col-lg-6">
                                <div class="box box-warning">					
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Cargas Virales</h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>                                    
                                    <div class="box-body">
                                        <div class="row">                                            
                                            <div class="col-lg-12">

                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Carga</th>
                                                                <th>Dif</th>
                                                                <th>Log</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($analytics2 as $analytic2)
                                                            <tr>
                                                                <td><?php echo date("d/m/Y", strtotime($analytic2->created_at)); ?></td>
                                                                <?php $resultados2 = json_decode($analytic2->result); ?>
                                                                @foreach($resultados2 as $resultado2)
                                                                    <td>{{ $resultado2 }}</td>
                                                                @endforeach
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
                    </div> 					
                </div>
            </div>
        </div>  --}}
        
        <div class="row mt-3">
            <div class="col-lg-7">
                
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
                                            <tr>
                                                <th>@lang('messages.start_date')</th>
                                                <th>@lang('messages.end_date')</th>
                                                <th>@lang('messages.name_data')</th>
                                                {{-- <th>@lang('messages.dose_data')</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($treatments as $treatment)
                                            <tr>
                                                <td>{{ $treatment->treatment_starting_date ?? "[".\Lang::get('messages.there_is_no_starting_date')."]" }}</td>
                                                <td>{{ $treatment->treatment_end_date ?? "[".\Lang::get('messages.there_is_no_ending_date')."]" }}</td>

                                                <td>{{ $treatment->nameMedicine }}</td>
                                                {{-- <td>
                                                    {{ $treatment->treatment_end_date }}
                                                </td> --}}
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
            <div class="col-lg-5">
                
                <div class="box box-danger">					
                    <div class="box-header with-border">
                      <h3 class="box-title">@lang('messages.sessions_date')</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool sesiones" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('messages.name_data')</th>
                                                <th>@lang('messages.start_date')</th>
                                                <th>@lang('messages.end_date')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($protocols as $protocol)
                                            <tr>
                                                <td>{{ $protocol->name }}</td>
                                                <td><?php echo date("d/m/Y", strtotime($protocol->starting_date)); ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($protocol->ending_date)); ?></td>                                               
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
	</div>

@endsection

@section('viewsScripts')
    <script>
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