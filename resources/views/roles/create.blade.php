
  <link rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toggle.css') }}">

  <div id="error-container-modal" class="alert alert-danger dNone"></div>
  <form id="newRole">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">@lang('messages.role_name')</label>
                                <input id="name" name="name" class="form-control" type="text" 
                                placeholder="@lang('messages.enter_the_role_name')" required>
                                <div class="invalid-feedback">
                                    <div>
                                      @lang('messages.the_role_name_is_required')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                          <table class="table table-responsive" id="tablaNuevoRolPermisos">
                            <caption>@lang('messages.permissions_associated_to_the_role')</caption>
                            <thead>
                              <th>@lang('messages.unit_name')</th>
                              <th>@lang('messages.activation_stat')</th>
                            </thead>
                            <tbody class="text-center">                                          
                                @if(count($permissions)>0)
                                  @foreach ($permissions as $permission)
                                      <tr>
                                        <td>{{ $permission['flag_meaning'] }}</td>
                                        <td>
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
                                        <td colspan="4">@lang('messages.there_are_no_selected_permissions')...</td>
                                    </tr>
                                @endif                           
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
  
  <script type="text/javascript" src="{{ asset('js/new-role.js') . '?r=' . rand() }}"></script>
  




