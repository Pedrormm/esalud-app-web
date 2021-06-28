@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="tabs">
			<div class="tab" name="Historiales Médicos">
				<div class="">

					{{ Form::open(array('url' => 'records', 'method' => 'POST','id' => 'recordsSearchForm',
					'class' => 'd-flex flex-row justify-content-center')) }}
						@csrf
						<div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2 d-inline-block">
							<select class="custom-select sel_ord filter_height" name="record_order_type" id="record_order_type">
								<option value="users.id">@lang('messages.ordered_by'):</option>
								<option value="lastname">@lang('messages.alphabetically_by_surnames')</option>
								<option value="name">@lang('messages.alphabetically_by_name')</option>
								<option value="historic">@lang('messages.from_lowest_to_highest_by_history_number')</option>
								<option value="dni">@lang('messages.from_lowest_to_highest_by_DNI')</option>
							</select>
						</div>
						<div class="form-group col-xs-6 col-sm-2 col-md-2 col-lg-2 d-inline-block">
							<select class="custom-select sel_sex filter_height" name="record_sex_filter" id="record_sex_filter">
								<option value="no">@lang('messages.men_and_women')</option>
								<option value="male">@lang('messages.men_stat')</option>
								<option value="female">@lang('messages.women_stat')</option>
							</select>
						</div>
						<div class="form-group col-xs-6 col-sm-2 col-md-2 col-lg-2 d-inline-block">
							<select class="custom-select sel_old filter_height" name="record_age_filter" id="record_age_filter">
								<option value="no">@lang('messages.any_age')</option>
								<option value="0-18">@lang('messages.-18yo_age')</option>
								<option value="18-24">@lang('messages.18-24yo_age')</option>
								<option value="24-40">@lang('messages.24-40yo_age')</option>
								<option value="40-65">@lang('messages.40-65yo_age')</option>
								<option value="65-140">@lang('messages.+65yo_age')</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 d-inline-block">
							<input type="text" placeholder="@lang('messages.name_surname_historial_or_DNI')" 
							class="inp_search filter_height" name="record_search_filter" id="record_search_filter">
						</div>
						<div class="col-lg-2 d-inline-block">
							<button type="submit" id="hmsearch" class="col-xs-12 btn btn-primary bt-search
							filter_height btn-block"><i class="fa fa-search"></i> @lang('messages.search_data')</a>
						</div>
					
					{{ Form::close() }}

				</div>

				
				<div class="row">       
					@foreach(array_chunk($patients, 2) as $chunk)
					<!-- Solo obtener pacientes relacionados con usuarios -->
						<!-- <div class="card shadow mb-4" id="mainCardShadow"> -->
						<div class="col-lg-6">
							@foreach($chunk as $patient)								
									<!-- START card-->
									<div class="card card-default card-demo records-color" id=""  >
										<div class="card-header records-color" >
											<a class="float-left title-style" name="records"
											href="{{ URL::asset('/singleRecord/'.$patient['id']) }}"/> 
											{{ urldecode($patient['name'])." ". urldecode($patient['lastname'])}}
											</a>
											
											<a class="float-right card-btn" data-tool="card-dismiss" 
											data-toggle="tooltip">
												<em class="fa fa-times"></em>
											</a>
											<a class="float-right card-btn" data-tool="card-collapse" 
											data-toggle="tooltip" data-start-collapsed>
												<em class="fa fa-plus"></em>
											</a>
										</div><!-- .card-wrapper is the element to be collapsed-->
										<div class="card-wrapper">
											<div class="card-body" id="mainCardBody">
												<div class="record_item" name="{{ $patient['id'] }}">
													<a name="records" href="{{ URL::asset('/singleRecord/'.$patient['id']) }}"/>                        
													<div class="box">
														<div class="record_left text-center pt-3">
															@if (!empty($patient['avatar']))
																<img src="{{ asset('images/avatars/'.$patient['avatar']) }}" class="avatar big"/>
															@else
																@if ($patient['sex']=="male")
																	<img src="{{ asset('images/avatars/user_man.png') }}" class="avatar big ">                                                               
																@endif
																@if ($patient['sex']=="female")
																	<img src="{{ asset('images/avatars/user_woman.png') }}" class="avatar big">                                                               
																@endif
															@endif
														</div> <!-- record_left  -->
														<div class="record_right">
															<div class="row">
																<div class=" col-xs-12 col-md-12 col-lg-7">
																	<div class="row p-3">
																		<span class="r_title col-xs-4 col-md-4 text-nowrap font-weight-bold ">@lang('messages.name_data'):</span>
																		<span class="col-xs-8 col-md-8 dots leftRecordRow">{{ urldecode($patient['name']) }}</span>
																		<span class="r_title col-xs-4 col-md-4 text-nowrap font-weight-bold">@lang('messages.surname_data'):</span>
																		<span class="col-xs-8 col-md-8 dots leftRecordRow">{{ urldecode($patient['lastname']) }}</span>
																		<span class="r_title col-xs-4 col-md-4 text-nowrap font-weight-bold">@lang('messages.historical_stat'):</span>
																		<span class="col-xs-8 col-md-8 dots leftRecordRow">{{ $patient['historic'] }}</span>
																		<span class="r_title col-xs-4 col-md-4 text-nowrap font-weight-bold">DNI:</span>
																		<span class="col-xs-8 col-md-8 leftRecordRow">{{ $patient['dni'] }}</span>
																	</div>
																</div>
																<div class="hidden-xs hidden-sm col-md-12 col-lg-5">
																	<div class="row p-3">
																		<span class="r_title hidden-xs col-sm-6 text-nowrap font-weight-bold">@lang('messages.age_data'):</span>
																		<span class="col-xs-12 col-sm-6">{{ \Carbon\Carbon::parse($patient['birthdate'])->age }}</span>
																		<span class="r_title hidden-xs col-sm-6 text-nowrap font-weight-bold">@lang('messages.gender_data'):</span>
																		<span class="col-xs-12 col-sm-6 text-nowrap">{{ $patient['sex']='male'?\Lang::get('messages.male_data'):\Lang::get('messages.female_data') }}</span>
																		<span class="r_title hidden-xs col-sm-6 text-nowrap font-weight-bold">@lang('messages.height_data'):</span>
																		<span class="col-xs-12 col-sm-6">{{ $patient['height'] }}</span>
																		<span class="r_title hidden-xs col-sm-6 text-nowrap font-weight-bold">@lang('messages.weight_data'):</span>
																		<span class="col-xs-12 col-sm-6">{{ $patient['weight'] }}</span>
																	</div>
																</div>              
															</div>          
														</div>  <!-- record_right  -->    
													</div> <!-- box  -->
												</div> <!-- record_item  -->
											</div>
											<div class="card-footer records-color"  ></div>
										</div>
									</div><!-- END card-->
							   
							@endforeach <!-- patient  -->
						</div> <!-- row  -->
					@endforeach <!-- chunk  -->
					 </div> 
				</div> <!-- list_records  -->        
		</div>
	</div>

           
@endsection




@section('viewsScripts')
	<script>
		$(function() {
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
				if(sessionStorage.getItem('search') !== '') {
					$('#record_search_filter').val(sessionStorage.getItem('search'));
				}
			}
		});

		// if (screen.width <= 1024){
		if (isMobile()){
			$('.leftRecordRow').removeClass('pl-4');
		}else{
			$('.leftRecordRow').addClass('pl-4');
		}
	</script>
@endsection