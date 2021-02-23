@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Gestión de roles</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table   table-bordered" id="mainTableRoles" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Nombre de rol</th>
                      <th>Ver usuarios</th><!-- boton ver -->
                      <th>Usuario creador</th><!-- El nick o nombre y apellidos solamente -->
                      <th>Número de usuarios aplicados</th><!-- numero de usuarios que se le aplica este rol -->
                      <th>Editar</th><!-- boton actualizar (solo disponible si somos nosotros mismos) -->
                      <th>Eliminar</th><!-- boton eliminar (solo disponible si somos nosotros mismos) -->
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
          Crear nuevo rol
          </a>  

          {{-- "{{ URL::to('roles/create') }}" --}}

        </div>
        <!-- /.container-fluid -->

  <script type="text/javascript" src="{{ asset('js/role-management.js')}}"></script>

@endsection