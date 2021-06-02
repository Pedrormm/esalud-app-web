@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.staff_list')</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="scheduleStaffTable" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.lastnamesurnamecoma_and_name')</th>
                    <th class="bg-primary">DNI</th>
                    <th class="bg-primary">@lang('messages.role_stat')</th>
                    <th class="bg-primary">@lang('messages.specialty_stat')</th>
                    <th class="bg-primary">@lang('messages.date_of_birth')</th>
                    <th class="bg-primary">@lang('messages.gender_data')</th>
                    <th class="bg-primary">@lang('messages.check_schedule')</th>
                    <th class="bg-primary">@lang('messages.delete_schedule')</th>
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
  @include('schedule.schedule-all-staff')
@endsection