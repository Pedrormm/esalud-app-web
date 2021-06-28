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
            <h4 class="font-weight-bold text-primary centered">@lang('messages.create_treatment')</h4>
  
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

            {{-- {{ Form::open(array('url' => '/treatments/'.$selectedUser["id"].'/store', 'method' => 'POST', 'id'=>'createTreatmentForm')) }} --}}
            {{ Form::open(array('id'=>'createNewTreatmentForm')) }}

                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <h3>@lang('messages.treatment_data') @lang('messages.of_the_user') 
                            {{ $selectedUser["name"] ." ".$selectedUser["lastname"]}}
                        </h3>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="doctorId">@lang('messages.doctor_type')</label>
                            <select id="doctorId" name="doctor_id" required class="selectpicker show-tick form-control" data-width="100%" 
                            data-live-search="true" title="@lang('messages.doctor_type')">
                                @foreach ($doctors as $doctor)
                                    <option value={{ $doctor->id }}>{{ $doctor->name . " " . $doctor->lastname }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="typeMedicinesId">@lang('messages.type_of_medicine')</label>
                            <select id="typeMedicinesId" name="type_medicines_id" required class="selectpicker show-tick form-control" 
                            data-width="100%" data-live-search="true" title="@lang('messages.type_of_medicine')">
                                @foreach ($typeMedicines as $typeMedicine)
                                    <option value={{ $typeMedicine->id }} >{{ $typeMedicine->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="medicinesAdministrationId">@lang('messages.medicine_administration')</label>
                            <select id="medicinesAdministrationId" name="medicines_administration_id" required 
                            class="selectpicker show-tick form-control" data-width="100%" 
                            data-live-search="true" title="@lang('messages.medicine_administration')">
                                @foreach ($medicinesAdministration as $medicineAdministration)
                                    <option value={{ $medicineAdministration->id }}>{{ $medicineAdministration->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                </div> 

                <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-lg-11 mx-auto">
                        <div class="form-group">
                            <label for="treatmentDescription">@lang('messages.description_stat')</label>
                            <textarea class="form-control mx-auto" id="treatmentDescription" rows="3" 
                            placeholder="@lang('messages.description_stat')" name="description"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-lg-4">
                        <label>@lang('messages.treatment_start_date')</label>
                        <input type="date" class="form-control" name="treatment_start_date" id="treatment_start_date"/>
                    </div>
                    <div class="col-lg-4">
                        <label>@lang('messages.treatment_end_date')</label>
                        <input type="date" class="form-control" name="treatment_end_date" id="treatment_end_date"/>
                    </div>
                </div>

                <div class="row mt-3" id="createTreatmentButton">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle"></i> 
                            @lang('messages.create_stat')
                        </button>
                    </div>
                </div>

            {{ Form::close() }}
            {{-- </form> --}}
            

        @endif
        </div>
    </div>

  </div>

  @endsection

    @section('viewsScripts')
        <script>
            $('.cHeader button').on('click', function(e){
                e.preventDefault();
                window.location.href = _publicUrl+"treatments/";
            });

            $('#createTreatmentButton').on("click",function(e){
                e.preventDefault();
                let id= {{ $selectedUser["id"] }};

                let  input = $('<input>').attr("type","hidden").attr("name","userId").attr("value",id);
                input.appendTo( "#createNewTreatmentForm" );
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                    url:_publicUrl+'treatments',
                    method:"POST",
                    data: $("#createNewTreatmentForm").serialize(),
                    dataType:"json",
                    contenttype: "application/json; charset=utf-8",
                }).done(function(response){
                    // console.log("resp ", response);
                    showInlineMessage(response.message, 30);
                    // console.log("app ",response.obj);

                });
            });


        </script>
    @endsection



