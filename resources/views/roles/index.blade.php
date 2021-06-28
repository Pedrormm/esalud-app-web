@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">@lang('messages.role_management')</h4>
            </div>

            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
                <table class="table table-bordered changableTable" id="mainTableRoles" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>@lang('messages.role_name')</th>
                      <th>@lang('messages.see_users')</th><!-- boton ver -->
                      <th>@lang('messages.user_creator')</th><!-- El nick o nombre y apellidos solamente -->
                      <th>@lang('messages.number_of_users_on_this_role')</th><!-- numero de usuarios que se le aplica este rol -->
                      <th>@lang('messages.edit_stat')</th><!-- boton actualizar (solo disponible si somos nosotros mismos) -->
                      <th>@lang('messages.delete_stat')</th><!-- boton eliminar (solo disponible si somos nosotros mismos) -->
                    </tr>
                  </thead>             
                </table>
              </div>
            </div>

          {{-- <a href="{{ URL::asset('/role/newRole/')  }}" class="btn btn-primary borderShadow" 
          id="usersDistRole" data-name-role=""><i class="fa fa-plus-circle"></i>&ensp;
          Crear nuevo rol
          </a>   --}}
          {{-- <a href="{{ route('roles.create')  }}" class="btn btn-primary borderShadow" 
          id="usersDistRole" data-name-role=""><i class="fa fa-plus-circle"></i>&ensp;
          Crear nuevo rol
          </a>   --}}
          <a href="{{ URL::asset('roles/create')  }}" class="btn btn-primary borderShadow" 
          id="usersDistRole" data-name-role=""><i class="fa fa-plus-circle"></i>&ensp;
          @lang('messages.create_new_role')
          </a>  

          {{-- "{{ URL::to('roles/create') }}" --}}

        </div>
        <!-- /.container-fluid -->


@endsection

@section('viewsScripts')
  <script type="text/javascript" src="{{ asset('js/role-management.js')}}"></script>
@endsection