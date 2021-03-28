@extends('layout.logged')

@section('nav-bar-top')

@endsection

@section('content')


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4" id="mainCardShadow">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Listado de pacientes</h4>
            </div>

            <input id="isallUsersDelete" type="hidden" 
            value="{{ isset($flagsMenuEnabled['ALL_USERS_DELETE']) && $flagsMenuEnabled['ALL_USERS_DELETE'] }}">

            <div class="card-body" id="mainCardBody">
              <div class="table-responsive">
                <table class="table table-bordered" id="mainTableAllUsers" width="100%" cellspacing="0">
                    <thead >
                      <tr class="text-center">
                          <th class="bg-primary">Apellidos, Nombre</th>
                          <th class="bg-primary">Rol</th>
                          <th class="bg-primary">Dni</th>
                          <th class="bg-primary">Grupo sanguíneo</th>
                          <th class="bg-primary">Fecha de nacimiento</th>
                          <th class="bg-primary">Teléfono</th>
                          <th class="bg-primary">Sexo</th>
                          <th class="bg-primary">Acciones</th>
                      </tr>
                    </thead>
                    @if(!(isset($flagsMenuEnabled['ALL_USERS_DELETE'])) && !($flagsMenuEnabled['ALL_USERS_DELETE']))
                      <tbody>
                        @foreach($users as $singleUser) 
                      
                        <tr class="text_left">
                            <td class="text_left">
                                @if ($singleUser['sex']=="male")
                                    <img class="avatar" src="{{ asset('images/avatars/user_man.png') }}" class="avatar big">                                                               
                                @endif
                                @if ($singleUser['sex']=="female")
                                    <img class="avatar" src="{{ asset('images/avatars/user_woman.png') }}" class="avatar big">                                                               
                                @endif
                                <span>{{ urldecode($singleUser['lastname']).", ".urldecode($singleUser['name']) }}</span>
                            </td>
                            <td>                        
                                <span>{{ App\Models\Role::find($singleUser['role_id'])->name }}</span>          
                            </td>
                            <td>
                                <span>{{ $singleUser['dni'] }}</span>          
                            </td>
                            <td>
                                <span>{{ $singleUser['blood'] }}</span>                    
                            </td>
                            <td>
                                <span>{{ date('d/m/Y', strtotime($singleUser['birthdate'])) }}</span>                    
                            </td>
                            <td>
                                <span>{{ $singleUser['phone'] }}</span>                    
                            </td>
                            <td>
                                <span>{{ $singleUser['sex'] }}</span>                   
                            </td>
                            <td>
                                {{-- @if ($singleUser['role_id'] !== \HV_ROLES::ADMIN) --}}
                                @if(isset($flagsMenuEnabled['ALL_USERS_EDIT']) && $flagsMenuEnabled['ALL_USERS_EDIT'])
                                  <span>
                                    <a href="{{ URL::asset('users/'.$singleUser['id'].'/edit')  }}"><i class="fa fa-edit"></i></a>
                                  </span>   
                                @else
                                  <span>
                                    <i class="fa fa-edit" style="color:gray"></i>
                                  </span> 
                                @endif    
                                @if(isset($flagsMenuEnabled['ALL_USERS_DELETE']) && $flagsMenuEnabled['ALL_USERS_DELETE'])
                                  <span>
                                    <a class="confirmDeleteUser" data-name-user="{{ $singleUser['name']." ".$singleUser['lastname'] }}"
                                    data-role-user="{{ App\Models\Role::find($singleUser['role_id'])->name }}" 
                                    data-id-user="{{  $singleUser['id'] }}"
                                    href="{{ URL::asset('users/'.$singleUser['id'].'/confirmDelete')  }}"><i class="fa fa-trash"></i></a>
                                  </span>   
                                @else
                                  <span>
                                    <i class="fa fa-trash" style="color:gray"></i>
                                  </span> 
                                @endif    
                            </td>
                        </tr>

                        @endforeach


                      </tbody>
                    @endif
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

@section('scriptsPropios')
  {{-- <script type="text/javascript" src="{{ asset('js/users-index.js') }}"></script> --}}
  @include('users.users-index', ['pagination'=>$pagination])

@endsection
