


  <form action="{{ URL::asset('/roles/userManagementNotInRole/update')  }}" method="POST" id="editNotInRole">
    {{ csrf_field() }}
    <input type="hidden" name="urlNotInRole" id="urlNotInRole" value="{{ URL::asset('/roles/userManagementNotInRole/update')  }}"> 
  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {{-- Buscador --}}
                                <select id="userspicker"
                                 class="selectpicker mx-auto users-picker" data-live-search="true"
                                multiple title="Busque por nombre, apellidos o dni" data-style="btn-info" 
                                data-width="35%" multiple data-actions-box="true" data-header="Busque por nombre, apellidos o dni"
                                multiple>
                                  @foreach($usersNotInRole as $roleName => $usersRole)
                                  <optgroup label="{{ $roleName }}">
                                    @foreach($usersRole as  $users)
                                      <option data-subtext="{{ $users->dni }}" value="{{ $users->id }}">
                                        {{ $users->name}}&nbsp;{{$users->lastname}}</option>
                                    @endforeach
                                  </optgroup>
                                  @endforeach
                                </select>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        {{-- Tabla invisible --}}
                        <table id="tableUsersNotInRole" class="display">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Nombre y apellidos</th>
                                <th>DNI</th>
                                <th>Edad</th>
                                <th>@lang('messages.gender')</th>
                                <th>@lang('messages.blood group')</th>
                                <th>Cambiar rol</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>Id</th>
                                <th>Nombre y apellidos</th>
                                <th>DNI</th>
                                <th>Edad</th>
                                <th>@lang('messages.gender')</th>
                                <th>@lang('messages.blood group')</th>
                                <th>Cambiar rol</th>
                              </tr>
                            </tfoot>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
  
  <script>
    allUsers = @json($allUsers);
    clickOnSelectpicker();
  </script>
  <script type="text/javascript" src="{{ asset('js/users-not-in-role.js') . '?r=' . rand() }}"></script>



