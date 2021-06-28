@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')


        <!-- Begin Page Content -->
        <div class="container-fluid">

          
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.list_of_users')</h4>
            </div>

            <input id="isallUsersDelete" type="hidden" 
            value="{{ isset($flagsMenuEnabled['ALL_USERS_DELETE']) && $flagsMenuEnabled['ALL_USERS_DELETE'] }}">

            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
                <table class="table table-bordered changableTable" id="mainTableAllUsers" width="100%" cellspacing="0">
                    <thead >
                      <tr class="text-center">
                          <th class="bg-primary">@lang('messages.lastnamesurnamecoma_and_name')</th>
                          <th class="bg-primary">@lang('messages.role_stat')</th>
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

      {{-- </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> --}}


@endsection

{{-- @section('viewsScripts') --}}
  {{-- <script type="text/javascript" src="{{ asset('js/users-index.js') }}"></script> --}}
  @if(!(isset($pagination)))
    @include('users.users-index', ['pagination'=>\HV_PAGINATION])
  @else 
    @include('users.users-index', ['pagination'=>$pagination])
  @endif

{{-- @endsection --}}
