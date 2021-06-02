  
  <form id="deleteSchedule">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="mainCardBody">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label id="sureDeleteSchedule" for="sureDeleteSchedule" data-delete-id="{{ $singleUser->id }}">
                                    @lang('messages.are_you_sure_you_want_to_delete_all_schedules_of_the_user') {{ $singleUser->name }} {{ $singleUser->lastname }}?
                                </label>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
  


