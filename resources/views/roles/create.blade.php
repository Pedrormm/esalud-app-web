
  <link rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/roleEdit.css') }}"> --}}

  <div id="error-container-modal" class="alert alert-danger dNone"></div>
  <form id="newRole">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Nombre del rol</label>
                                <input id="name" name="name" class="form-control" type="text" 
                                placeholder="Introuzca el nombre del rol" required>
                                <div class="invalid-feedback">
                                    <div>
                                        El Nombre del rol es requerido
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                          {{-- <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label"> --}}
                          {{-- <table class="table table-stripped table-bordered table-hover table-sm w-auto tabla_permisos_roles text-center"> --}}
                          <table class="table table-responsive" id="tablaNuevoRolPermisos">
  
                            <caption>Permisos asociados al rol</caption>
                            <thead>
                              <th>Módulo</th>
                              <th>Activación</th>
                            </thead>
                            <tbody class="text-center">                                          
                                @if(count($permissions)>0)
                                  @foreach ($permissions as $permission)
                                      <tr>
                                        <td>{{ $permission['flag_meaning'] }}</td>
                                        <td >
                                          <input name="check-{{ $permission['id'] }}" 
                                          id="check-{{ $permission['id'] }}" type="checkbox" >
                                          <label for="check-{{ $permission['id'] }}" class="check-trail">
                                            <span class="check-handler"></span>
                                          </label>
                                          
                                        </td>
                                      </tr>
                                  @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No hay permisos seleccionados...</td>
                                    </tr>
                                @endif                           
                            </tbody>
                          </table>
                          {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toggle.css') }}">
  <script type="text/javascript" src="{{ asset('js/application.js') }}"></script>
  
  <script type="text/javascript" src="{{ asset('js/new-role.js') . '?r=' . rand() }}"></script>
  




