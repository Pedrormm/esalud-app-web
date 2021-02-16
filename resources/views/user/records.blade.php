{{-- @extends('layout.logged', ['flagsMenuEnabled' =>  $flagsMenuEnabled]); --}}
@extends('layout.logged');

@section('nav-bar-top')
    <!-- <nav class="top">
        <div class="div_2 on">Historiales médicos</div>
    </nav> -->
@endsection

@section('content')
	
	<div class="container-fluid">
		<div class="tabs">
			<div class="tab" name="Historiales Médicos">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<select class="custom-select sel_ord filter_height" id="record_order_type">
							<option value="users.id">Ordenado por:</option>
							<option value="lastname">Alfbabéticamente por apellidos</option>
							<option value="name">Alfbabéticamente por Nombre</option>
							<option value="historic">De menor a mayor por NªHistorial</option>
							<option value="dni">De menor a mayor por DNI</option>
						</select>
					</div>
					<div class="form-group col-xs-6 col-sm-2 col-md-2 col-lg-2">
						<select class="custom-select sel_sex filter_height" id="record_sex_filter">
							<option value="no">Hombres y Mujeres</option>
							<option value="male">Hombres</option>
							<option value="female">Mujeres</option>
						</select>
					</div>
					<div class="form-group col-xs-6 col-sm-2 col-md-2 col-lg-2">
						<select class="custom-select sel_old filter_height" id="record_age_filter">
							<option value="no">Cualquier edad</option>
							<option value="0-18">- 18 años</option>
							<option value="18-24">18 a 24 años</option>
							<option value="24-40">24 a 40 años</option>
							<option value="40-65">40 a 65 años</option>
							<option value="65-140">+ 65 años</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<input type="text" placeholder="Nombre, apellidos, historial o dni" class="inp_search filter_height" id="record_search_filter">
					</div>
					<div class="col-lg-2">
					<button type="button" id="hmsearch" class="col-xs-12 btn btn-primary bt-search
					 filter_height btn-block"><i class="fa fa-search"></i> Buscar</a>
					</div>
					
				</div>

				
				<div class="row">       
					@foreach(array_chunk($patients, 2) as $chunk)
					<!-- Solo obtener pacientes relacionados con usuarios -->
						<!-- <div class="card shadow mb-4"> -->
						<div class="col-lg-6">
							@foreach($chunk as $patient)								
									<!-- START card-->
									<div class="card card-default card-demo records-color" id=""  >
										<div class="card-header records-color" >
											<a class="float-left title-style" name="records"
											 href="/user/singlerecord/{{$patient['id']}}">
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
											<div class="card-body">
												<div class="record_item" name="{{ $patient['id'] }}">
													<a name="records" href="{{ URL::asset('/user/singlerecord/'.$patient['id']) }}"/>                        
													<div class="box">
														<div class="record_left">
															@if ($patient['sex']=="male")
																<img src="{{ asset('images/avatars/user_man.PNG') }}" class="avatar big">                                                               
															@endif
															@if ($patient['sex']=="female")
																<img src="{{ asset('images/avatars/user_woman.PNG') }}" class="avatar big">                                                               
															@endif
														</div> <!-- record_left  -->
														<div class="record_right">
															<div class="row">
																<div class=" col-xs-12 col-md-12 col-lg-8">
																	<div class="row">
																		<span class="r_title col-xs-4 col-md-4">Nombre:</span>
																		<span class="col-xs-8 col-md-8 dots">{{ urldecode($patient['name']) }}</span>
																		<span class="r_title col-xs-4 col-md-4">Apellidos:</span>
																		<span class="col-xs-8 col-md-8 dots">{{ urldecode($patient['lastname']) }}</span>
																		<span class="r_title col-xs-4 col-md-4">Historial:</span>
																		<span class="col-xs-8 col-md-8 dots">{{ $patient['historic'] }}</span>
																		<span class="r_title col-xs-4 col-md-4">DNI:</span>
																		<span class="col-xs-8 col-md-8">{{ $patient['dni'] }}</span>
																	</div>
																</div>
																<div class="hidden-xs hidden-sm col-md-12 col-lg-4">
																	<div class="row">
																		<span class="r_title hidden-xs col-sm-6">Edad:</span>
																		<span class="col-xs-12 col-sm-6">{{ \Carbon\Carbon::parse($patient['birthdate'])->age }}</span>
																		<span class="r_title hidden-xs col-sm-6">Sexo:</span>
																		<span class="col-xs-12 col-sm-6">{{ $patient['sex'] }}</span>
																		<span class="r_title hidden-xs col-sm-6">Altura:</span>
																		<span class="col-xs-12 col-sm-6">{{ $patient['height'] }}</span>
																		<span class="r_title hidden-xs col-sm-6">Peso:</span>
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
            if(sessionStorage.getItem('search') !== '') {
                $('#record_search_filter').val(sessionStorage.getItem('search'));
            }
        }
    });

    $('#hmsearch').click(function(e) {        
        let ord = $('#record_order_type').val();
        let sexFilter = $('#record_sex_filter').val();
        let ageFilter = $('#record_age_filter').val();
        let nameSearch = $('#record_search_filter').val();

        sessionStorage.setItem('order', ord);
        sessionStorage.setItem('sex', sexFilter);
        sessionStorage.setItem('age', ageFilter);
        sessionStorage.setItem('search', nameSearch);


        location.href = "{{url('user/records')}}" + "/" + ord + "/" + sexFilter + "/" 
        + ageFilter + "/" + nameSearch;
    });
</script>
           
@endsection