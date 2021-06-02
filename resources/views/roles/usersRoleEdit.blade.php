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
                <h4 class="font-weight-bold text-primary centered"> @lang('messages.associated_users_to_the_role')  {{ $usersRole[0]["name"] }}</h4>

              </div>
            </div>



            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableRoles" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>@lang('messages.ID_data')</th>
                      <th>@lang('messages.full_name')</th>
                      <th>DNI</th>
                      <th>@lang('messages.age_data')</th>
                      <th>@lang('messages.gender_data')</th>
                      <th>@lang('messages.blood_group')</th>
                      <th>@lang('messages.change_role')</th>
                    </tr>
                  </thead>
                </table>       
              </div>
            </div>

              <a href="{{ URL::asset('/roles/userManagementNotInRole/edit/'.$id)  }}" class="btn btn-primary borderShadow" 
                id="usersDistRole" data-name-role="{{ $usersRole[0]["name"] }}"><i class="fa fa-search"></i>
                 @lang('messages.look_for_associated_users_that_have_a_different_role_than')  {{ $usersRole[0]["name"] }}
              </a>   

        </div>
        <!-- /.container-fluid -->




@endsection

@section('viewsScripts')
  <script>
    let currentIdRole = {{ $id }};
    let roles = @json($roles);

  </script>

  <script type="text/javascript" src="{{ asset('js/users-role-edit.js')}}"></script>
@endsection

