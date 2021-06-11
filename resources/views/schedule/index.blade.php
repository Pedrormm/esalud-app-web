@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          
          <div class="card shadow mb-4" id="indexScheduleCard">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.my_available_schedule')</h4>
            </div>

            <div class="card-body" id="mainStaffScheduleBody">
              <div class="hv-schedule">
                <div class='hv-header'>
                    <div></div>
                    <div>@lang('messages.monday_stat')</div>
                    <div>@lang('messages.tuesday_stat')</div>
                    <div>@lang('messages.wednesday_stat')</div>
                    <div>@lang('messages.thursday_stat')</div>
                    <div>@lang('messages.friday_stat')</div>
                    <div>@lang('messages.saturday_stat')</div>
                    <div>@lang('messages.sunday_stat')</div>
                </div>
                <div class="hv-hours"></div>
            </div>

        </div>
        <button type="button" id="SaveSchedule"> @lang('messages.save_stat')</button>

        <!-- /.container-fluid -->

@endsection

@section('viewsScripts')
  <script type="text/javascript" src="{{ asset('js/schedule-index.js')  . '?r=' . rand() }}"></script>
@endsection