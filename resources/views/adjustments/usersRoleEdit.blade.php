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
                <h4 class="font-weight-bold text-primary centered">Usuarios asociados al rol {{ $usersRole[0]["name"] }}</h4>

              </div>
            </div>



            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
                <table class="table table-bordered" id="tableRoles" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Id</th>
                      <th>Nombre y apellidos</th>
                      <th>DNI</th>
                      <th>Edad</th>
                      <th>Sexo</th>
                      <th>Grupo sanguíneo</th>
                      <th>Cambiar rol</th>
                    </tr>
                  </thead>
                </table>       
              </div>
            </div>

              <a href="{{ URL::asset('/roles/userManagementNotInRole/edit/'.$id)  }}" class="btn btn-primary borderShadow" 
                id="usersDistRole" data-name-role="{{ $usersRole[0]["name"] }}"><i class="fa fa-search"></i>
                Buscar usuarios asociados a un rol distinto de {{ $usersRole[0]["name"] }}
              </a>   

        </div>
        <!-- /.container-fluid -->

  <script>

    let currentIdRole = {{ $id }};
    let roles = @json($roles);

  </script>

<script type="text/javascript" src="{{ asset('js/users-role-edit.js')}}"></script>


@endsection

