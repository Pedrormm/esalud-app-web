
  <link rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/roleEdit.css') }}"> --}}
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toggle.css') }}">



  <form id="editRole">
    {{ csrf_field() }}
    <input type="hidden" id="idRole" name="idRole" value="{{ $roles['id'] }}">
    {{-- <input type="hidden" name="urlRole" id="urlRole" value="{{ URL::asset('/user/roleManagement/update')  }}"> --}}
  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="firstName">@lang('messages.role_name')</label>
                                <input id="name" name="name" class="form-control" type="text" 
                                placeholder=@lang('messages.enter_the_role_name') value="{{ $roles['name'] }}">
                                <div  class="invalid-feedback">
                                    <div>
                                      @lang('messages.the_role_name_is_required')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($roles['id'] != \HV_ROLES::ADMIN)
                      <div class="row justify-content-center">
                        <div class="col-auto">
                        
                          <table class="table table-responsive display" id="tablaRolPermisos">
  
                            <caption>@lang('messages.permissions_associated_to_the_role')</caption>
                              <thead>
                                <tr>
                                  <th>@lang('messages.unit_name')</th>
                                  <th>@lang('messages.activation_stat')</th>
                                </tr>
                              </thead>
                            <tbody class="text-center">                                          
                                @if(count($roles['roles_permissions'])>0)
                                  @foreach ($roles['roles_permissions'] as $role_permission)
                                      <tr>
                                        <td>{{ $role_permission['permission']['flag_meaning'] }}</td>
                                        <td >
                                          <input name="check-{{ $role_permission['id'] }}" 
                                          id="check-{{ $role_permission['id'] }}" type="checkbox" 
                                          {{ ($role_permission['activated']=='1')?'checked':'' }}>
                                          <label for="check-{{ $role_permission['id'] }}" class="check-trail">
                                            <span class="check-handler"></span>
                                          </label>
                                          
                                        </td>
                                      </tr>
                                  @endforeach
                                @else
                                <tr>
                                  <td colspan="4">@lang('messages.there_are_no_selected_permissions')...</td>
                                </tr>
                                @endif                           
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </form>
  
  <script>
    roleId = {{ $roles['id'] }};
  </script>

  <script type="text/javascript" src="{{ asset('js/role-edit.js') . '?r=' . rand() }}"></script>
  
  
  




