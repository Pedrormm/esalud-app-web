@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">Listado de pacientes</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered changableTable" id="mainTablePatientsTreatments" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.lastnamesurnamecoma_and_name')</th>
                    <th class="bg-primary">DNI</th>
                    <th class="bg-primary">@lang('messages.blood_group')</th>
                    <th class="bg-primary">@lang('messages.date_of_birth')</th>
                    <th class="bg-primary">@lang('messages.gender_data')</th>
                    @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_CREATE']) && $flagsMenuEnabled['MEDICAL_TREATMENT_CREATE'])
                      <th class="bg-primary">@lang('messages.create_treatment')</th>
                    @endif
                    @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_FROM_SINGLE_PATIENT']) && $flagsMenuEnabled['MEDICAL_TREATMENT_SHOW_FROM_SINGLE_PATIENT'])
                      <th class="bg-primary">@lang('messages.view_treatments')</th>
                    @endif
                    @if(isset($flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ALL_FROM_SINGLE_PATIENT']) && $flagsMenuEnabled['MEDICAL_TREATMENT_DELETE_ALL_FROM_SINGLE_PATIENT'])
                      <th class="bg-primary">@lang('messages.delete_all_the_treatments')</th>
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
  @include('treatments.treatments-index')
@endsection