  
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
                                    ¿Seguro que desea eliminar todos los horarios del usuario {{ $singleUser->name }} {{ $singleUser->lastname }}?
                                </label>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
  
  {{-- <script type="text/javascript" src="{{ asset('js/confirm-delete-user.js') . '?r=' . rand() }}"></script> --}}



