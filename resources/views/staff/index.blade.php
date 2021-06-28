{{-- @extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Staff</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('staff.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('staff.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection --}}

@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')          

    <!-- Begin Page Content -->
    <div class="container-fluid">

      
      <div class="card shadow mb-4" id="mainCardShadow">
        <div class="card-header py-3">
          <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.list_of_staff')</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered changableTable" id="mainTableStaff" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.lastnamesurnamecoma_and_name')</th>
                    <th class="bg-primary">@lang('messages.role_stat')</th>
                    <th class="bg-primary">@lang('messages.historical_stat')</th>
                    <th class="bg-primary">@lang('messages.specialty_stat')</th>
                    @if(isset($flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_ALL']) && $flagsMenuEnabled['SCHEDULE_SHOW_AND_EDIT_ALL'])
                      <th class="bg-primary">@lang('messages.check_schedule')</th>
                    @endif
                    {{-- <th class="bg-primary">@lang('messages.shift_data')</th> --}}
                    {{-- <th class="bg-primary">@lang('messages.office_data')</th>
                    <th class="bg-primary">@lang('messages.room_number')</th> --}}
                    <th class="bg-primary">@lang('messages.business_phone_number')</th>
                    <th class="bg-primary">DNI</th>
                    <th class="bg-primary">@lang('messages.blood_group')</th>
                    <th class="bg-primary">@lang('messages.date_of_birth')</th>
                    <th class="bg-primary">@lang('messages.phone_number')</th>
                    <th class="bg-primary">@lang('messages.gender_data')</th>
                    <th class="bg-primary">@lang('messages.actions_stat')</th>
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
  @include('staff.staff-index')
@endsection