@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

  <div class="container-fluid">

    <div class="card shadow mb-4" id="mainCardShadow">
      <div class="card-header py-3">
        <div class="row">
            <div class="cHeader col-2">
              <button type="button" class="btn btn-primary">
                  <i class="fas fa-arrow-left"></i>
              </button>
            </div>
            <h4 class="font-weight-bold text-primary centered">@lang('messages.edit_treatment')</h4>
  
          </div>

      </div>

      <div class="card-body" id="mainCardBody">
        
        @if(isset($showError))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <ul class="errorShown">
                                <li>{{ $error }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        @else

            <div id="error-container" class="alert alert-danger dNone"></div>
            <div id="message-container" class="alert alert-success dNone"></div>

            {{ Form::open(array('url' => '/treatments/'.$treatment->id, 'method' => 'PUT', 'id'=>'newUserMailForm')) }}
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.treatment_data')</h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <input type="hidden" value="{{ $treatment->id }}" name="treatment_id" />
                    <div class="col-lg-4">
                        <select name="doctor_id" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.doctor_type')>
                            @foreach ($doctors as $doctor)
                                <option value={{ $doctor->id }} {{ $treatment->userDoctor->id == $doctor->id ? 'selected' : "" }}>{{ $doctor->name . " " . $doctor->lastname }}</option>
                            @endforeach
                        </select> 
                    </div>

                    <div class="col-lg-4">
                        <select name="type_medicines_id" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.type_of_medicine')>
                            @foreach ($typeMedicines as $typeMedicine)
                                <option value={{ $typeMedicine->id }} {{ $treatment->typeMedicine->id == $typeMedicine->id ? 'selected' : "" }}>{{ $typeMedicine->name }}</option>
                            @endforeach
                        </select> 
                    </div>

                    <div class="col-lg-4">
                        <select name="medicines_administration_id" required class="selectpicker show-tick selectCurrentRole form-control" data-width="100%" 
                            data-live-search="true" title=@lang('messages.medicine_administration')>
                            @foreach ($medicinesAdministration as $medicineAdministration)
                                <option value={{ $medicineAdministration->id }} 
                                    {{ is_null($treatment->medicineAdministration)?"": 
                                    ($treatment->medicineAdministration->id == $medicineAdministration->id ? 'selected' : "") }}>{{ $medicineAdministration->name }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>

                <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-lg-11">
                        <textarea class="form-control" id="treatmentDescription" rows="3" value="{{ $treatment->description }}" placeholder=@lang('messages.description_stat') name="description"></textarea>
                    </div>
                </div>

                @if ($treatment->treatment_end_date > $today)
                    <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-lg-4">
                            <label>@lang('messages.treatment_end_date')</label>
                            <input required type="datetime-local" 
                            value="{{ !is_null($treatment->treatment_end_date)? substr($treatment->treatment_end_date,0, 10)."T".substr($treatment->treatment_end_date,11,16) :"" }}" 
                            class="form-control" name="treatment_end_date" />
                        </div>
                    </div>
                @endif

                <div class="row mb-3 ">
                    <div class="col-lg-2 offset-5 text-center">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> @lang('messages.edit_stat')</button>
                    </div>
                </div>

            {{ Form::close() }}
            {{-- </form> --}}
            

        @endif
        </div>
    </div>

  </div>

  {{-- <script type="text/javascript" src="{{ asset('js/newUserMail.js')}}"></script> --}}

  @endsection

    @section('viewsScripts')
        <script>
            $('.cHeader button').on('click', function(e){
                e.preventDefault();
                window.location.href = _publicUrl+"patients/";
            });
        </script>
    @endsection



