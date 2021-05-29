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
          <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.List of staff')</h4>
        </div>

        <div class="card-body" id="mainCardBody">
          <div class="table-responsive">
          <table class="table table-bordered" id="mainTableStaff" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                    <th class="bg-primary">@lang('messages.surname, name')</th>
                    <th class="bg-primary">@lang('messages.role')</th>
                    <th class="bg-primary">@lang('messages.Historical')</th>
                    <th class="bg-primary">@lang('messages.specialty')</th>
                    <th class="bg-primary">@lang('messages.Shift')</th>
                    <th class="bg-primary">@lang('messages.Office')</th>
                    <th class="bg-primary">@lang('messages.Room number')</th>
                    <th class="bg-primary">@lang('messages.Business phone number')</th>
                    <th class="bg-primary">Dni</th>
                    <th class="bg-primary">@lang('messages.blood group')</th>
                    <th class="bg-primary">@lang('messages.date of birth')</th>
                    <th class="bg-primary">@lang('messages.Phone number')</th>
                    <th class="bg-primary">@lang('messages.gender')</th>
                    <th class="bg-primary">@lang('messages.actions')</th>
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