


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
                                multiple title="@lang('messages.search_by_name_surname_or_DNI')" data-style="btn-info" 
                                data-width="35%" multiple data-actions-box="true" data-header="@lang('messages.search_by_name_surname_or_DNI')"
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
                      <div class="table-responsive-md">
                        {{-- Tabla invisible --}}
                        <table id="tableUsersNotInRole" class="display table">
                            <thead>
                              <tr>
                                <th>@lang('messages.ID_data')</th>
                                <th>@lang('messages.full_name')</th>
                                <th>DNI</th>
                                <th>@lang('messages.age_data')</th>
                                <th>@lang('messages.gender_data')</th>
                                <th>@lang('messages.blood_group')</th>
                                <th>@lang('messages.change_role')</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>@lang('messages.ID_data')</th>
                                <th>@lang('messages.full_name')</th>
                                <th>DNI</th>
                                <th>@lang('messages.age_data')</th>
                                <th>@lang('messages.gender_data')</th>
                                <th>@lang('messages.blood_group')</th>
                                <th>@lang('messages.change_role')</th>
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



