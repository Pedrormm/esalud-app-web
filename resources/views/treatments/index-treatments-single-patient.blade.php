@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">

          <div class="row">
            <div class="cHeader col-2">
              <button type="button" class="btn btn-primary">
                  <i class="fas fa-arrow-left"></i>
              </button>
            </div>
            <h4 class="font-weight-bold text-primary centered"> @lang('messages.list_of_treatments_of_pacient')  {{ $singlePatient->name . " " . $singlePatient->lastname }}</h4>
          </div>

          {{-- <h4 class="m-0 font-weight-bold text-primary text-center">Listado de tratamientos del paciente {{ $singlePatientFullName }}</h4> --}}
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="TableTreatmentsSinglePatient" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.start_date')</th>
                    <th class="bg-primary">@lang('messages.end_date')</th>
                    {{-- <th class="bg-primary">Paciente asociado</th> --}}
                    <th class="bg-primary">@lang('messages.doctor_in_charge')</th>
                    <th class="bg-primary">@lang('messages.medicine_drug')</th>
                    <th class="bg-primary">@lang('messages.medicine_administration')</th>
                    @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_EDIT']) && $flagsMenuEnabled['MEDICAL_TREATMENT_EDIT'])
                      <th class="bg-primary">@lang('messages.edit_treatment')</th>
                    @endif
                    @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_DESCRIPTION']) && $flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_DESCRIPTION'])        
                      <th class="bg-primary">@lang('messages.see_description')</th>
                    @endif
                    @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ONE']) && $flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ONE'])
                      <th class="bg-primary">@lang('messages.delete_treatment')</th>
                    @endif
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
    
@endsection


@section('viewsScripts')
  @include('treatments.treatments-single-patient', ['userId' => $singlePatient->id])
@endsection