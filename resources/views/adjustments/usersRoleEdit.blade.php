@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')

        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Usuarios asociados al rol {{ $usersRole[0]["name"] }}</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
              
                  <tbody>
                    {{-- <input type="hidden" name="urlNotInRole" id="urlNotInRole" value="{{ URL::asset('/role/userManagementNotInRole/update')  }}">  --}}

                    {{-- {{ dd($usersRole) }} --}}
                    @foreach ($usersRole[0]["user1s"] as $usersRoles)
                      <tr>
                        <td>{{ $usersRoles["id"]}}</td>
                        <td>{{ $usersRoles["name"]}}&nbsp;{{$usersRoles["lastname"]}}</td>
                        <td>{{ $usersRoles["dni"]}}</td>
                        <td>{{ \Carbon\Carbon::parse($usersRoles['birthdate'])->age }}&nbsp;años</td>
                        <td>{{ $usersRoles["sex"] }}</td>
                        <td>{{ $usersRoles["blood"] }}</td>
                        <td>
                          <select class="selectpicker show-tick selectCurrentRole" data-width="100%" data-live-search="true"
                          data-style="btn-success" data-user-id="{{ $usersRoles["id"]}}" id="selectCurrentRole">
                            @foreach ($roles as $role)
                              <option {{ ($usersRoles["role_id"]==$role->id)?'selected':'' }} value="{{ $role->id }}">
                                {{ $role->name }}</option>
                            @endforeach
                          </select>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                          
              </div>
            </div>

              <a href="{{ URL::asset('/role/userManagementNotInRole/edit/'.$id)  }}" class="btn btn-primary" 
                id="usersDistRole" data-name-role="{{ $usersRole[0]["name"] }}"><i class="fa fa-search"></i>
                Buscar usuarios asociados a un rol distinto de {{ $usersRole[0]["name"] }}
              </a>   

        </div>
        <!-- /.container-fluid -->

  <script type="text/javascript" src="{{ asset('js/users-role-edit.js')}}"></script>


@endsection

