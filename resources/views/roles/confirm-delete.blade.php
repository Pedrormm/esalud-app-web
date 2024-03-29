  
  <form id="deleteRole">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label id="sureDeleteRole" for="sureDeleteRole" data-role-delete-id="{{ $role->id }}">
                                    @lang('messages.are_you_sure_you_want_to_delete_the_role') {{ $role->name }}?
                                </label>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
  
  <script type="text/javascript" src="{{ asset('js/confirm-delete-role.js') . '?r=' . rand() }}"></script>



