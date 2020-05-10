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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
              
                  <tbody>
                    @foreach ($roles as $rol)
                      @php ($count = DB::table("users")->where('role_id', $rol->idRole)->get()->count())
                      <tr>
                        <td data-role-id="{{ $rol->idRole }}">{{ $rol->nameRole }}</td>
                        <td>
                          {{-- <button type="button" class="btn btn-primary">Usuarios asociados</a> --}}
                            <a href="{{ URL::asset('/role/userManagement/edit/'.$rol->idRole)  }}" class="btn btn-primary role-users-modal"
                              data-name-role="{{ $rol->nameRole }}" data-role-id="{{ $rol->idRole }}" role="button">
                              Usuarios asociados
                            </a>                       
                        </td>
                        <td>{{ $rol->dni }}</td>
                        <td>{{ $count }}</td>
                        <td>
                          <a href="{{ URL::asset('/user/roleManagement/edit/'.$rol->idRole)  }}" class="btn btn-primary role-modal"
                            data-name-role="{{ $rol->nameRole }}" data-role-id="{{ $rol->idRole }}" role="button">
                            Editar
                          </a>					
                        </td><!-- boton actualizar (solo disponible si somos nosotros mismos) -->
                        <td><button type="button" class="btn btn-danger" id="roleDelete"
                          data-role-id="{{ $rol->idRole }}"><i class="fa fa-trash"></i>&ensp;Borrar</button></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          <a href="{{ URL::asset('/role/userManagementNotInRole/edit/')  }}" class="btn btn-primary" 
          id="usersDistRole" data-name-role=""><i class="fa fa-plus-circle"></i>&ensp;
          Crear nuevo rol
          </a>  
          

        </div>
        <!-- /.container-fluid -->

  <script>


    $('.role-modal').on('click', function(e){
        e.preventDefault();
        showModal('Editar rol '+ $(this).data('name-role'), '', false, $(this).attr('href'), 'modal-xl', true, true); 
    });
  </script>

@endsection