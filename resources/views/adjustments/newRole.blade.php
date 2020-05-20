<link rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/roleEdit.css') }}">  
  
  <form id="newRole">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="firstName">Nombre del rol</label>
                                <input id="name" name="name" class="form-control" type="text" 
                                placeholder="Introuzca el nombre del rol">
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
                            <div class="bulgy-radios" role="radiogroup" aria-labelledby="bulgy-radios-label">
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
                                @if(count($permissions)>0)
                                    @foreach ($permissions as $permission)

                                        <tr>
                                        <td>{{ $permission['flag_meaning'] }}</td>
                                        <td>
                                            <label class="posRButton">
                                            <input type="radio" name="optradio{{ $permission['id'] }}" style="display:none"
                                             value="1"/>
                                            <span class="radio"></span>
                                            <span class="label"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="posRButton">
                                            <input type="radio" name="optradio{{ $permission['id'] }}" style="display:none"
                                             value="2"/>
                                            <span class="radio"></span>
                                            <span class="label"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="posRButton">
                                            <input type="radio" name="optradio{{ $permission['id'] }}" style="display:none"
                                             checked value="0"/>
                                            <span class="radio"></span>
                                            <span class="label"></span>
                                            </label>
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
    </div>
  </form>
  
 <script type="text/javascript" src="{{ asset('js/new-role.js') . '?r=' . rand() }}"></script>


