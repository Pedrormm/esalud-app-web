  <form>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="firstName">Nombre del rol</label>
                                <input id="name" name="name" class="form-control" type="text" placeholder="Ingrese el nombre">
                                <div  class="invalid-feedback">
                                    <div>
                                        El Nombre del rol es requerido
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-10">
                          <div class="form-group">
                            <label for="permissions">Módulo</label>
                            <select class="form-control" id="permissions">
                              @foreach ($permissions as $permission)
                              <option value="{{ $permission->id }}">{{ $permission->flag_meaning }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-2">
                          <button type="button" class="btn btn-primary" style="margin-top:2.4em">Agregar</button>
                        </div>                 
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <table class="table table-stripped table-bordered table-hover">
                          <thead>
                            <th>Módulo</th>
                            <th>Permiso</th>
                            <th></th>
                          </thead>
                          <tbody>
                           
                            
                            
                            <tr>
                              @if(count($roles['roles_permissions'])>0)
                                @foreach ($roles['roles_permissions'] as $role_permission)
                                    <tr>
                                      <td>{{ $role_permission['permission']['flag_meaning'] }}</td>
                                      <td>
                                        <select data-permission="{{  $role_permission['permission_id'] }}" " class="form-control role-permission">
                                          <option {{ ($role_permission['value_name']=='NONE')?'selected':'' }} value="NONE">Ninguno</option>
                                          <option {{ ($role_permission['value_name']=='READ')?'selected':'' }} value="READ">Lectura</option>
                                          <option {{ ($role_permission['value_name']=='READ_AND_WRITE')?'selected':'' }} value="READ_AND_WRITE">Lectura y Escritura</option>
                                        </select>

                                      </td>
                                      <td><button type="button" class="btn btn-danger">Borrar</button></td>
                                    </tr>
                                @endforeach
                              @else
                              <td colspan="2">No hay permisos seleccionados...</td>
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