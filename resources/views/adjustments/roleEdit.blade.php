<form action="{{ URL::asset('/user/roleManagement/update')  }}" method="PUT" id="editRole">
  {{ csrf_field() }}
  <input type="hidden" name="idRole" value="{{ $roles['id'] }}">
  <input type="hidden" name="urlRole" id="urlRole" value="{{ URL::asset('/user/roleManagement/update')  }}">

  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                  <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                              <label for="firstName">Nombre del rol</label>
                              <input id="name" name="name" class="form-control" type="text" 
                              placeholder="Introuzca el nombre del rol" value="{{ $roles['name'] }}">
                              <div  class="invalid-feedback">
                                  <div>
                                      El Nombre del rol es requerido
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-stripped table-bordered table-hover table-sm w-auto tabla_permisos_roles text-center">
                        <caption>Permisos asociados al rol</caption>
                        <thead>
                          <th>Módulo</th>
                          <th>Lectura</th>
                          <th>Lectura y escritura</th>
                          <th>Sin permisos</th>
                        </thead>
                        <tbody class="text-center">                                          
                          <tr>
                            @if(count($roles['roles_permissions'])>0)
                              @foreach ($roles['roles_permissions'] as $role_permission)
                                  <tr>
                                    <td>{{ $role_permission['permission']['flag_meaning'] }}</td>
                                    <td>
                                      <label class="radio-inline"><input type="radio" name="optradio{{ $role_permission['id'] }}"
                                         {{ ($role_permission['value_name']=='READ')?'checked':'' }} value="1"></label>
                                    </td>
                                    <td>
                                      <label class="radio-inline"><input type="radio" name="optradio{{ $role_permission['id'] }}" 
                                        {{ ($role_permission['value_name']=='READ_AND_WRITE')?'checked':'' }} value="2"></label>
                                    </td>
                                    <td>
                                      <label class="radio-inline"><input type="radio" name="optradio{{ $role_permission['id'] }}" 
                                        {{ ($role_permission['value_name']=='NONE')?'checked':'' }} value="0"></label>
                                    </td>
                                  </tr>
                              @endforeach
                            @else
                            <td colspan="4">No hay permisos seleccionados...</td>
                            @endif                           
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>


<script type="text/javascript" src="{{ asset('js/role-edit.js') }}"></script>
